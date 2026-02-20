# Quadly - Campus Social Network Presentation Script

## [0:00 - 2:30] Speaker 1 (Slides 1 - 5)

**Slide 1: Title & Introduction**  
**Speaker 1:**  
Good morning, respected teachers and fellow students. I am [Speaker 1 Name], and joining me today is my teammate, [Speaker 2 Name]. Under the guidance of Professor Mahwish Momin, we are proud to present our BCA Major Project for Dr. P.A Inamdar University. Our project is titled "Quadly" — a dedicated and secure Campus Social Network designed exclusively for our university.

**Slide 2: Project Brief**  
**Speaker 1:**  
So, what exactly is Quadly? Simply put, Quadly is a centralized academic and social engagement platform. Currently, students and faculty rely on unstructured public social media or scattered notice boards. Quadly provides a secure, digital communication hub that is restricted entirely to our campus. It features strict role-based access control, ensuring that only verified students, faculty, and administrators can log in, share information, and collaborate safely.

**Slide 3: Project Objectives**  
**Speaker 1:**  
Our vision for Quadly is driven by eight core objectives. First and foremost, we wanted to build a closed, campus-restricted platform with highly secure authentication. We aim to centralize communication—making digital announcements effortless for faculty—while boosting academic collaboration. Additionally, Quadly provides dedicated tools for campus club management. By enforcing role-based access, we can guarantee that student engagement remains secure, relevant, and entirely insulated from outside interference.

**Slide 4: System Comparison (Existing vs. Proposed)**  
**Speaker 1:**  
To understand the value of Quadly, let's look at the existing system versus our proposed solution. The current communication methods are largely manual—relying heavily on physical notices or unverified platforms like WhatsApp groups, which often leads to unstructured data and a high risk of misinformation.  
Quadly solves this by transitioning our campus to a centralized digital hub. We enforce verified access via institutional credentials and maintain strict admin controls, creating a secure, organized, and efficient environment where no important update is ever missed.

**Slide 5: System Architecture & Modules**  
**Speaker 1:**  
Technically, Quadly is built on a robust 3-Tier MVC Architecture using CodeIgniter 3.  
- The **Presentation Layer** handles the UI and client-side AI modules.  
- The **Application Layer** processes the business logic using PHP and Apache.  
- The **Data Layer** securely persists our information using a structured MySQL database.  

The system encompasses seven core modules, ranging from biometric registration and access control to the campus feed and global search. Now, with a smooth transition, I will hand over the presentation to [Speaker 2 Name], who will dive deeper into these functionalities and the technology making them possible.

---

## [2:30 - 5:00] Speaker 2 (Slides 6 - 10)

**Slide 6: Key Modules & Functionality**  
**Speaker 2:**  
Thank you, [Speaker 1 Name]. Let's explore the key capabilities of Quadly in more detail.  
Our **Registration and Login systems** are highly advanced. We utilize Smart Verification with OCR and Face AI to enroll students using their physical ID cards and biometric data. This enables a seamless and secure "Login-by-Face" feature, alongside traditional secure authentication.  
Once logged in, users access the **Profile and Campus Feed** modules. The feed supports rich multimedia and engagement tools, utilizing a priority algorithm to keep crucial faculty notices at the top. We also have dedicated spaces for **Clubs & Events**, making event discovery effortless. Overseeing all of this is our comprehensive **Admin Panel**, giving administrators full control over user lifecycles and platform moderation.

**Slide 7: Technology Stack**  
**Speaker 2:**  
To build this, we employed a modern Full Stack ecosystem.  
Our **Frontend layer** utilizes HTML5, Tailwind CSS, and ES6 JavaScript to deliver a highly responsive experience.  
On the **Backend**, we rely on PHP running on CodeIgniter 3 and Apache, utilizing BCrypt for secure password hashing.  
Our **Database layer** runs on MariaDB or MySQL, utilizing optimized relational schemas.  
Most notably, we incorporated **Specialized AI Tools** running directly on the client side—specifically `face-api.js` for biometric verification and `Tesseract.js` for scanning ID cards via OCR.

**Slide 8: Software & Hardware Requirements**  
**Speaker 2:**  
Here is what is required to run Quadly effectively.  
For the **Server**, a standard Linux environment running Apache, PHP, and MySQL with at least 4 Gigabytes of RAM will handle the backend operations smoothly.  
For the **Client or End User**, any modern web browser on a smartphone, tablet, or laptop will work perfectly. Because we utilize client-side AI, the user’s device should ideally have a 720p camera for face ID and a basic multi-core processor to handle the facial recognition calculations.

**Slide 9: Limitations & Future Scope**  
**Speaker 2:**  
While Quadly is comprehensive, there are a few limitations. Currently, the AI performance heavily relies on the user’s device capabilities and optimal lighting conditions. Additionally, our biometric libraries require an active internet connection.  
However, our future roadmap is very promising. We plan to expand Quadly by developing Native Mobile Apps for iOS and Android, and implementing Progressive Web App features for offline support. On the backend, we aim to integrate Redis load balancing and implement Machine Learning-assisted moderation to automatically detect abusive content.

**Slide 10: Conclusion & Q&A**  
**Speaker 2:**  
In conclusion, we believe Quadly will significantly modernize how our university connects, communicates, and collaborates. Thank you to our guide, Professor Mahwish Momin, and the faculty for your time and support.  
This concludes our presentation. We are now open to any questions you may have.
