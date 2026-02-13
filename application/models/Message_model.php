<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model
{

    public function send_message($sender_id, $receiver_id, $message, $attachment_path = null, $type = 'text')
    {
        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
            'attachment_path' => $attachment_path,
            'message_type' => $type,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('messages', $data);
    }

    public function get_conversation($user1_id, $user2_id)
    {
        $this->db->select('messages.*, user.first_name, user.last_name, user.profile_photo');
        $this->db->from('messages');
        $this->db->join('users as user', 'user.id = messages.sender_id');
        $this->db->group_start();
        $this->db->where('sender_id', $user1_id);
        $this->db->where('receiver_id', $user2_id);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('sender_id', $user2_id);
        $this->db->where('receiver_id', $user1_id);
        $this->db->group_end();
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get()->result();
    }

    public function get_recent_conversations($user_id)
    {
        // Complex query to get most recent message for each conversation
        $sql = "SELECT m.*, u.id as user_id, u.first_name, u.last_name, u.profile_photo, u.username
                FROM messages m
                JOIN users u ON (m.sender_id = u.id OR m.receiver_id = u.id)
                WHERE (m.sender_id = ? OR m.receiver_id = ?)
                AND u.id != ?
                AND m.id IN (
                    SELECT MAX(id)
                    FROM messages
                    WHERE sender_id = ? OR receiver_id = ?
                    GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)
                )
                ORDER BY m.created_at DESC";

        return $this->db->query($sql, [$user_id, $user_id, $user_id, $user_id, $user_id])->result();
    }

    public function get_all_media()
    {
        $this->db->select('messages.*, sender.first_name as sender_first, sender.last_name as sender_last, sender.profile_photo as sender_photo, receiver.first_name as receiver_first, receiver.last_name as receiver_last');
        $this->db->from('messages');
        $this->db->join('users as sender', 'sender.id = messages.sender_id');
        $this->db->join('users as receiver', 'receiver.id = messages.receiver_id');
        $this->db->where_in('message_type', ['image', 'video']);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
}
