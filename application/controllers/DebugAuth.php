<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DebugAuth extends CI_Controller
{

    public function index()
    {
        if (!is_cli()) {
            echo "<pre>";
        }

        echo "--- Debugging Auth (Full List) ---\n";

        $this->load->model('User_model');

        $users = $this->db->get('users')->result();

        echo "Total Users: " . count($users) . "\n";
        echo sprintf("%-5s | %-30s | %-20s | %-10s\n", "ID", "Email", "Student ID", "Role");
        echo str_repeat("-", 70) . "\n";

        $student_id_counts = [];

        foreach ($users as $u) {
            $email = isset($u->email) ? (string) $u->email : '';
            echo sprintf(
                "%-5s | %-30s | %-20s | %-10s\n",
                $u->id,
                substr($email, 0, 28),
                $u->student_id,
                $u->role
            );

            if (!empty($u->student_id)) {
                if (!isset($student_id_counts[$u->student_id])) {
                    $student_id_counts[$u->student_id] = 0;
                }
                $student_id_counts[$u->student_id]++;
            }
        }

        echo "\n--- Duplicate Check ---\n";
        $found_dupes = false;
        foreach ($student_id_counts as $id => $count) {
            if ($count > 1) {
                echo "WARNING: Student ID '$id' is used by $count users!\n";
                $found_dupes = true;
            }
        }

        if (!$found_dupes) {
            echo "No duplicate Student IDs found.\n";

            // Test verification for '123' specifically if it exists and is unique
            if (isset($student_id_counts['123']) && $student_id_counts['123'] == 1) {
                echo "\n[Testing Verification for Student ID: 123]\n";
                $this->db->group_start();
                $this->db->where('email', '123');
                $this->db->or_where('student_id', '123');
                $this->db->group_end();
                $query = $this->db->get('users');

                if ($query->num_rows() == 1) {
                    echo "SUCCESS: Login query now returns exactly 1 row for '123'. Login should work!\n";
                } else {
                    echo "FAILURE: Login query returned " . $query->num_rows() . " rows.\n";
                }
            }
        }

        if (!is_cli()) {
            echo "</pre>";
        }
    }

    public function fix()
    {
        if (!is_cli()) {
            echo "<pre>";
        }

        echo "--- Fixing Duplicates ---\n";

        // Fix for ID 4
        $this->db->where('id', 4);
        $this->db->update('users', ['student_id' => '123_old_4']);
        echo "Updated User ID 4: student_id -> 123_old_4\n";

        // Fix for ID 6
        $this->db->where('id', 6);
        $this->db->update('users', ['student_id' => '123_old_6']);
        echo "Updated User ID 6: student_id -> 123_old_6\n";

        echo "Fix complete. Run 'index' again to verify.\n";

        if (!is_cli()) {
            echo "</pre>";
        }
    }
}
