
## Part 1: Normalization (3NF)

 The design eliminates data redundancy and prevents update/insert/delete anomalies.

| Table Name | Primary Key | Foreign Key | Normal Form | Description |
| :--- | :--- | :--- | :--- | :--- |
| **Students** | `student_id` | None | 3NF | Stores unique student profile information |
| **Professors** | `prof_id` | None | 3NF | Stores faculty contact details separately |
| **Courses** | `course_id` | `prof_id` | 3NF | Catalog of courses and assigned instructors |
| **Enrollments** | `(student_id, course_id)` | `student_id`, `course_id` | 3NF | Junction table for grades and student-course mapping |

---

## 🏗️ Detailed Schema Representation

### 1. Table: `Students`
| student_id | student_name |
| :--- | :--- |
| 1 | Nguyen An |
| 2 | Tran Binh |

### 2. Table: `Professors`
| prof_id | prof_name | prof_email |
| :--- | :--- | :--- |
| P01 | Dr. Le | le@uni.edu |
| P02 | Dr. Tran | tran@uni.edu |

### 3. Table: `Courses`
| course_id | course_name | prof_id |
| :--- | :--- | :--- |
| 101 | Database Systems | P01 |
| 102 | Web Development | P02 |

### 4. Table: `Enrollments`
| student_id | course_id | grade |
| :--- | :--- | :--- |
| 1 | 101 | A |
| 1 | 102 | B+ |
| 2 | 101 | A- |

---

## 🛠️ Normalization Logic

* **1NF (First Normal Form):** Ensured atomicity; each column contains only a single value from the domain.
* **2NF (Second Normal Form):** Removed **Partial Dependencies**. `StudentName` was moved to the `Students` table because it only depends on `StudentID`, not the composite key of the enrollment.
* **3NF (Third Normal Form):** Removed **Transitive Dependencies**. In the raw data, `ProfessorEmail` depended on `ProfessorName`, which depended on `CourseID`. These were extracted into a standalone `Professors` table to ensure data integrity.

### Key Improvements
* **Reduced Redundancy:** Student names and Professor emails are stored exactly once.
* **Integrity:** Updating a Professor's email now requires changing only one record in the `Professors` table.
* **Extensibility:** New courses or professors can be added to the system even if no students have enrolled yet.
##  Part 2: Relationship 
# Database Design: Entity Relationship Drills

This document analyzes the cardinality and foreign key (FK) placement for the specified entity pairs, adhering to standard Relational Database Management System (RDBMS) normalization principles.

---

### 1. Author — Book
* **Relationship Type:** One-to-Many (1:N)
    * *Rationale:* In a standard publishing model, one **Author** can pen multiple **Books**. Conversely, for this exercise, a specific **Book** is authored by one primary individual.
* **FK Location:** **Book table**
    * The `author_id` is placed in the child table (Book) to reference the unique identifier of the parent table (Author).

### 2. Citizen — Passport
* **Relationship Type:** One-to-One (1:1)
    * *Rationale:* A single **Citizen** is legally issued one **Passport**, and a specific **Passport** is uniquely assigned to one **Citizen**.
* **FK Location:** **Passport table**
    * In a 1:1 relationship, the FK is typically situated in the optional entity or the entity that depends on the existence of the other.

### 3. Customer — Order
* **Relationship Type:** One-to-Many (1:N)
    * *Rationale:* A **Customer** initiates multiple **Orders** over time. However, an individual **Order** is linked exclusively to the single **Customer** who made the purchase.
* **FK Location:** **Order table**
    * The `customer_id` resides in the Order table to maintain referential integrity with the Customer entity.

### 4. Student — Class
* **Relationship Type:** Many-to-Many (N:N)
    * *Rationale:* A **Student** enrolls in multiple **Classes**, while a single **Class** contains a roster of numerous **Students**.
* **FK Location:** **Junction Table (Associative Entity)**
    * To resolve an N:N relationship, a third table (e.g., `Enrollment`) is required. This table hosts two Foreign Keys: `student_id` and `class_id`.

### 5. Team — Player
* **Relationship Type:** One-to-Many (1:N)
    * *Rationale:* A professional **Team** consists of a roster of multiple **Players**, whereas a **Player** is registered to only one **Team** at a given time.
* **FK Location:** **Player table**
    * The `team_id` is stored in the Player table as a Foreign Key to denote their team affiliation.
