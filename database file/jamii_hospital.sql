-- create database Jamii1_hospital; 
-- use Jamii1_hospital;
-- -- drop database Jamii1_hospital;

-- PatientManagement Module
CREATE TABLE Patients (
     patient_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(100) NOT NULL,
    address VARCHAR(200),
    contact VARCHAR(20),
    datetime_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (patient_id, contact) 
);

-- Staff Management Module
CREATE TABLE Departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL,
    description TEXT,
    department_type VARCHAR(50),
    UNIQUE KEY (dept_name,dept_id)
);
CREATE TABLE Staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(50),
    contact VARCHAR(20),
    specialization VARCHAR(100),
    dept_id INT,
    FOREIGN KEY (dept_id) REFERENCES Departments(dept_id),
    UNIQUE KEY (staff_id, contact)
);

CREATE TABLE Doctors (
doc_id INT AUTO_INCREMENT PRIMARY KEY,
doc_name VARCHAR(100) NOT NULL,
specialization VARCHAR(100),
staff_id int not null,
foreign key (staff_id) references Staff (staff_id)                                                                                                          
);
-- alter table Doctors 
-- drop foreign key doctors_ibfk_2;
-- alter table doctors 
-- drop column patient_id;


CREATE TABLE patient_medical_history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    Patient_diagnosis VARCHAR(100),
    medication VARCHAR(200),
    diagnosis_date DATE,
    notes text,
    patient_id  INT NOT NULL,
    staff_id INT NOT NULL,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    unique key(history_id)
);
-- drop table patient_medical_history;
-- Inserting data into patient_medical_history table
INSERT INTO patient_medical_history (Patient_diagnosis, medication, diagnosis_date, notes, patient_id, staff_id)
VALUES
    ('Hypertension', 'Lisinopril', '2023-05-15', 'Prescribed medication for high blood pressure', 1, 1),
    ('Fractured Arm', 'Ibuprofen', '2023-07-20', 'Administered pain relief medication', 2, 2),
    ('Allergic Reaction', 'Benadryl', '2023-09-10', 'Treated allergic reaction with antihistamine', 3, 3),
    ('Diabetes', 'Metformin', '2023-11-05', 'Started patient on diabetes medication regimen', 4, 4),
    ('Asthma', 'Albuterol', '2023-12-15', 'Prescribed inhaler for asthma management', 5, 5),
    ('Arthritis', 'Celecoxib', '2024-01-20', 'Prescribed medication for arthritis pain relief', 6, 6),
    ('Migraine', 'Sumatriptan', '2024-03-08', 'Provided medication for migraine relief', 7, 7);

-- alter table patient_medical_history
-- drop column doc_id ;
--                                                       -- Patient Membership Module
CREATE TABLE patient_membership (
    membership_id INT AUTO_INCREMENT PRIMARY KEY,
    membership_type varchar(50),
    membership_start_date DATE,
    membership_end_date DATE,
    membership_fee DECIMAL(10, 2),
    membership_benefits TEXT,
     patient_id int not null,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    unique key(membership_id)
);
-- Inserting data into patient_membership table
INSERT INTO patient_membership (membership_type, membership_start_date, membership_end_date, membership_fee, membership_benefits, patient_id)
VALUES
    ('Gold', '2023-01-01', '2023-12-31', 500.00, 'Access to all hospital facilities, priority appointments, discounted services', 1),
    ('Silver', '2023-02-15', '2023-12-31', 300.00, 'Access to select hospital facilities, discounted services', 2),
    ('Platinum', '2023-03-10', '2024-03-10', 800.00, 'Access to all hospital facilities, priority appointments, free annual check-up', 3),
    ('Basic', '2023-04-20', '2023-12-31', 200.00, 'Access to basic hospital services', 4),
    ('Premium', '2023-05-05', '2023-12-31', 600.00, 'Access to all hospital facilities, priority appointments', 5),
    ('Standard', '2023-06-30', '2023-12-31', 400.00, 'Access to select hospital facilities', 6),
    ('VIP', '2023-07-12', '2023-12-31', 1000.00, 'Access to all hospital facilities, priority appointments, dedicated staff', 7);

-- Modify patient_medical_history table to include doctor_id
-- ALTER TABLE patient_medical_history ADD COLUMN doctor_id INT NOT NULL;
-- ALTER TABLE patient_medical_history ADD CONSTRAINT FK_patient_medical_history_Doctors FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id);

                             --  beds and wards module-- 
                             
CREATE TABLE Wards (
    ward_id INT AUTO_INCREMENT PRIMARY KEY,
    ward_name VARCHAR(100) NOT NULL,
    ward_type varchar (30),
    unique key (ward_id)
);                             
CREATE TABLE Beds (
    bed_id INT AUTO_INCREMENT PRIMARY KEY,
    bed_number VARCHAR(20) NOT NULL,
    status ENUM('Occupied', 'Vacant') NOT NULL DEFAULT 'Vacant',
     ward_id INT NOT NULL,
    fOREIGN KEY (ward_id) REFERENCES Wards(ward_id),
    unique key(bed_id)
);
INSERT INTO Wards (ward_name, ward_type)
VALUES
    ('Pediatrics', 'General'),
    ('Orthopedics', 'Specialized'),
    ('Maternity', 'General'),
    ('ICU', 'Specialized'),
    ('Surgery', 'General'),
    ('Oncology', 'Specialized'),
    ('Psychiatric', 'Specialized');
 
 INSERT INTO Beds (bed_number, status, ward_id)
VALUES
    ('101', 'Vacant', 1),
    ('102', 'Occupied', 1),
    ('103', 'Vacant', 2),
    ('104', 'Vacant', 2),
    ('105', 'Occupied', 3),
    ('106', 'Vacant', 3),
    ('107', 'Vacant', 4),
    ('108', 'Occupied', 4),
    ('109', 'Vacant', 5),
    ('110', 'Occupied', 5),
    ('111', 'Vacant', 6),
    ('112', 'Vacant', 6),
    ('113', 'Vacant', 7),
    ('114', 'Vacant', 7);



                                                             -- Pharmacy Management Module
CREATE TABLE Medications (
med_id INT AUTO_INCREMENT PRIMARY KEY,
med_name VARCHAR(100),
dosage_form varchar (100), -- form in which the medication is administred-- 
unique key (med_id)
);
CREATE TABLE Prescriptions (
    pres_id INT AUTO_INCREMENT PRIMARY KEY,
     prescription_date datetime,
    medication_detail TEXT,
	patient_id INT NOT NULL,
    staff_id INT NOT NULL,
    med_id int not null,
    foreign key (med_id) references Medications (med_id),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (staff_id) REFERENCES staff (staff_id),
    unique key(pres_id)
);
-- drop table Prescriptions;
                                                 -- billing module-- 
CREATE TABLE Billings (
    bill_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    total_amount DECIMAL(10, 2) DEFAULT 0,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    unique key (bill_id)
);

CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    bill_id INT NOT NULL,-- 
    payment_date DATE,
    amount DECIMAL(10, 2),
    payment_method VARCHAR(50),
    patient_id int not null,
    FOREIGN KEY (bill_id) REFERENCES Billings(bill_id),
     FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
     unique key (payment_id)
);

CREATE TABLE Billing_Services (
service_id INT AUTO_INCREMENT PRIMARY KEY,
bill_id INT NOT NULL,
service_type VARCHAR(50) NOT NULL,
service_amount DECIMAL(10, 2) NOT NULL,
FOREIGN KEY (bill_id) REFERENCES Billings(bill_id)
);

-- Integration with Other Modules
-- ALTER TABLE Consultations ADD COLUMN service_id INT;
-- ALTER TABLE Consultations ADD CONSTRAINT FK_Consultations_Billing_Services FOREIGN KEY (service_id) REFERENCES Billing_Services(service_id);

-- ALTER TABLE Admissions ADD COLUMN service_id INT;
-- ALTER TABLE Admissions ADD CONSTRAINT FK_productsAdmissions_Billing_Services FOREIGN KEY (service_id) REFERENCES Billing_Services(service_id);


-- ALTER TABLE Prescriptions ADD COLUMN service_id INT;
-- ALTER TABLE Prescriptions ADD CONSTRAINT FK_Prescriptions_Billing_Services FOREIGN KEY (service_id) REFERENCES Billing_Services(service_id);

                              --  emergency module
Create table Emergency_patients(
empatient_id int auto_increment primary key,
empatient_name varchar (250),
contact varchar(20),
datetime_added datetime
);

CREATE TABLE Emergencies (
    emergency_id INT AUTO_INCREMENT PRIMARY KEY,
    emergency_type VARCHAR(100) NOT NULL,
    emergency_date DATE NOT NULL,
    emergency_details TEXT,
    staff_id INT NOT NULL,
	empatient_id INT NOT NULL,
    FOREIGN KEY (empatient_id) REFERENCES Emergency_patients(empatient_id),
    FOREIGN KEY (staff_id) REFERENCES Staff(staff_id)
);
-- drop table emergencies;
-- Inserting data into Emergency_patients table
INSERT INTO Emergency_patients (empatient_name, contact, datetime_added)
VALUES
    ('John Doe', '1234567890', NOW()),
    ('Jane Smith', '9876543210', NOW()),
    ('Michael Johnson', '5551234567', NOW()),
    ('Emily Davis', '9998887776', NOW()),
    ('David Wilson', '3334445555', NOW()),
    ('Sarah Brown', '7776665554', NOW()),
    ('Robert Jones', '1112223334', NOW());

-- Inserting data into Emergencies table
INSERT INTO Emergencies (emergency_type, emergency_date, emergency_details, staff_id, empatient_id)
VALUES
    ('Heart Attack', '2024-04-08', 'Patient experiencing severe chest pain', 1, 1),
    ('Fracture', '2024-04-08', 'Patient with broken arm', 2, 2),
    ('Allergic Reaction', '2024-04-08', 'Patient showing signs of anaphylaxis', 3, 3),
    ('Seizure', '2024-04-08', 'Patient having a seizure', 4, 4),
    ('Head Injury', '2024-04-08', 'Patient with head trauma after fall', 5, 5),
    ('Drug Overdose', '2024-04-08', 'Patient overdosed on medication', 6, 6),
    ('Breathing Difficulty', '2024-04-08', 'Patient having difficulty breathing', 7, 7);


                                  --  Appointment module
CREATE TABLE Appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    staff_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
--     appointment_reason TEXT,
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
);
-- ALTER TABLE Appointments MODIFY reason TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- drop table Appointments;

-- Patient Consultation and Treatment Module
CREATE TABLE Consultations (
consultation_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT NOT NULL,
staff_id INT NOT NULL,
consultation_date DATE,
notes TEXT,
FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
FOREIGN KEY (staff_id) REFERENCES Staff(staff_id)
);

CREATE TABLE Consultation_Chats (
chat_id INT AUTO_INCREMENT PRIMARY KEY,
consultation_id INT NOT NULL,
chat_start_time TIMESTAMP,
chat_end_time TIMESTAMP,
FOREIGN KEY (consultation_id) REFERENCES Consultations(consultation_id)
);


-- Post Service Monitoring Module
CREATE TABLE Post_Service_Monitoring (
monitoring_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT NOT NULL,
consultation_id INT NOT NULL,
monitoring_start_date DATE,
monitoring_end_date DATE,
notes TEXT,
FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
FOREIGN KEY (consultation_id) REFERENCES Consultations(consultation_id)
);

-- users after signing in from the website
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
--     confirmPassword varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unique (email,username,phone,password)
);
-- drop table Login;

-- CREATE TABLE Login (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) UNIQUE NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role ENUM('admin', 'doctor', 'receptionist', 'accountant', 'matron') NOT NULL
-- );

-- INSERT INTO Login (username, password,role) 
-- VALUE
-- ('admin', 'admin_password', 'admin'),
-- ('doctor1', 'password1', 'doctor'),
-- ('receptionist1', 'password2', 'receptionist'),
-- ('accountant1', 'password3', 'accountant'),
-- ('matron1', 'password4', 'matron');


-- Inserting data into Patients table
INSERT INTO Patients (patient_name, address, contact)
VALUES 
    ('John Doe', '123 Main Street', '123-456-7890'),
    ('Jane Smith', '456 Elm Street', '987-654-3210'),
    ('Michael Johnson', '789 Oak Street', '555-123-4567'),
    ('Emily Brown', '321 Pine Street', '777-888-9999'),
    ('David Wilson', '555 Maple Street', '111-222-3333'),
    ('Sarah Davis', '888 Birch Street', '444-555-6666'),
    ('Lisa Taylor', '777 Cedar Street', '222-333-4444');

-- Inserting data into Departments table
INSERT INTO Departments (dept_name, description, department_type)
VALUES
    ('Cardiology', 'Deals with heart-related issues', 'Medical'),
    ('Orthopedics', 'Specializes in bone and joint issues', 'Medical'),
    ('Pediatrics', 'Focuses on children''s healthcare', 'Medical'),
    ('Oncology', 'Specializes in cancer treatment', 'Medical'),
    ('Emergency Medicine', 'Handles emergency cases', 'Medical'),
    ('Surgery', 'Performs surgical procedures', 'Medical'),
    ('Psychiatry', 'Deals with mental health disorders', 'Medical');

-- Inserting data into Staff table
INSERT INTO Staff (name, role, contact, specialization, dept_id)
VALUES
    ('Dr. Smith', 'Cardiologist', '555-111-2222', 'Heart Specialist', 1),
    ('Dr. Johnson', 'Orthopedic Surgeon', '555-222-3333', 'Bone Specialist', 2),
    ('Dr. Williams', 'Pediatrician', '555-333-4444', 'Children''s Health Specialist', 3),
    ('Dr. Brown', 'Oncologist', '555-444-5555', 'Cancer Specialist', 4),
    ('Dr. Davis', 'Emergency Physician', '555-555-6666', 'Emergency Care Specialist', 5),
    ('Dr. Wilson', 'Surgeon', '555-666-7777', 'General Surgeon', 6),
    ('Dr. Taylor', 'Psychiatrist', '555-777-8888', 'Mental Health Specialist', 7);

-- Inserting data into Medications table
INSERT INTO Medications (med_name, dosage_form)
VALUES
    ('Aspirin', 'Tablet'),
    ('Ibuprofen', 'Capsule'),
    ('Amoxicillin', 'Liquid'),
    ('Lisinopril', 'Tablet'),
    ('Simvastatin', 'Tablet'),
    ('Levothyroxine', 'Tablet'),
    ('Metformin', 'Tablet');

-- Inserting data into Prescriptions table
INSERT INTO Prescriptions (prescription_date, medication_detail, patient_id, staff_id, med_id)
VALUES
    ('2024-04-08 10:00:00', 'Take one tablet daily with food', 1, 1, 1),
    ('2024-04-08 11:00:00', 'Take one capsule twice a day', 2, 2, 2),
    ('2024-04-08 12:00:00', 'Take one teaspoonful three times a day', 3, 3, 3),
    ('2024-04-08 13:00:00', 'Take one tablet daily before bedtime', 4, 4, 4),
    ('2024-04-08 14:00:00', 'Take one tablet daily in the morning', 5, 5, 5),
    ('2024-04-08 15:00:00', 'Take one tablet daily on an empty stomach', 6, 6, 6),
    ('2024-04-08 16:00:00', 'Take one tablet twice a day with meals', 7, 7, 7);

-- Inserting data into Billings table
INSERT INTO Billings (patient_id, total_amount)
VALUES
    (1, 100.00),
    (2, 150.00),
    (3, 200.00),
    (4, 250.00),
    (5, 300.00),
    (6, 350.00),
    (7, 400.00);

-- Inserting data into Payments table
INSERT INTO Payments (bill_id, payment_date, amount, payment_method, patient_id)
VALUES
    (1, '2024-04-08', 50.00, 'Cash', 1),
    (2, '2024-04-08', 100.00, 'Credit Card', 2),
    (3, '2024-04-08', 150.00, 'Debit Card', 3),
    (4, '2024-04-08', 200.00, 'Cash', 4),
    (5, '2024-04-08', 250.00, 'Credit Card', 5),
    (6, '2024-04-08', 300.00, 'Debit Card', 6),
    (7, '2024-04-08', 350.00, 'Cash', 7);

-- Inserting data into Billing_Services table
INSERT INTO Billing_Services (bill_id, service_type, service_amount)
VALUES
    (1, 'Consultation', 50.00),
    (2, 'Prescription', 100.00),
    (3, 'Lab Test', 150.00),
    (4, 'Surgery', 200.00),
    (5, 'Medication', 250.00),
    (6, 'Therapy', 300.00),
    (7, 'Radiology', 350.00);

-- Inserting data into Emergencies table
INSERT INTO Emergencies (emergency_type, emergency_date, emergency_details, staff_id, empatient_id)
VALUES
    ('Heart Attack', '2024-04-08', 'Patient experiencing chest pain and shortness of breath', 1, 1),
    ('Fractured Leg', '2024-04-08', 'Patient fell down stairs and unable to move leg', 2, 2),
    ('Severe Allergic Reaction', '2024-04-08', 'Patient developed hives and difficulty breathing after bee sting', 3, 3),
    ('Major Car Accident', '2024-04-08', 'Patient involved in head-on collision with multiple injuries', 4, 4),
    ('Stroke', '2024-04-08', 'Patient experiencing sudden weakness and slurred speech', 5, 5),
    ('Seizure', '2024-04-08', 'Patient having uncontrollable shaking and loss of consciousness', 6, 6),
    ('Suicide Attempt', '2024-04-08', 'Patient ingested large amount of pills', 7, 7);

-- Inserting data into Appointments table
INSERT INTO Appointments (patient_id, staff_id, appointment_date, appointment_time)
VALUES
    (1, 1, '2024-04-08', '08:00:00'),
    (2, 2, '2024-04-08', '09:00:00'),
    (3, 3, '2024-04-08', '10:00:00'),
    (4, 4, '2024-04-08', '11:00:00'),
    (5, 5, '2024-04-08', '12:00:00'),
    (6, 6, '2024-04-08', '13:00:00'),
    (7, 7, '2024-04-08', '14:00:00');

-- Inserting data into Consultations table
INSERT INTO Consultations (patient_id, staff_id, consultation_date, notes)
VALUES
    (1, 1, '2024-04-08', 'Patient complaining of chest pain and shortness of breath'),
    (2, 2, '2024-04-08', 'Patient presenting with fractured leg after fall'),
    (3, 3, '2024-04-08', 'Patient exhibiting severe allergic reaction to bee sting'),
    (4, 4, '2024-04-08', 'Patient involved in car accident with multiple injuries'),
    (5, 5, '2024-04-08', 'Patient showing signs of stroke with weakness and slurred speech'),
    (6, 6, '2024-04-08', 'Patient experiencing seizure with loss of consciousness'),
    (7, 7, '2024-04-08', 'Patient attempted suicide by ingesting pills');

-- Inserting data into Consultation_Chats table
INSERT INTO Consultation_Chats (consultation_id, chat_start_time, chat_end_time)
VALUES
    (1, '2024-04-08 08:00:00', '2024-04-08 08:30:00'),
    (2, '2024-04-08 09:00:00', '2024-04-08 09:30:00'),
    (3, '2024-04-08 10:00:00', '2024-04-08 10:30:00'),
    (4, '2024-04-08 11:00:00', '2024-04-08 11:30:00'),
    (5, '2024-04-08 12:00:00', '2024-04-08 12:30:00'),
    (6, '2024-04-08 13:00:00', '2024-04-08 13:30:00'),
    (7, '2024-04-08 14:00:00', '2024-04-08 14:30:00');

-- Inserting data into Post_Service_Monitoring table
INSERT INTO Post_Service_Monitoring (patient_id, consultation_id, monitoring_start_date, monitoring_end_date, notes)
VALUES
    (1, 1, '2024-04-08', '2024-04-10', 'Patient recovering well from heart attack'),
    (2, 2, '2024-04-08', '2024-04-10', 'Patient recovering from leg surgery'),
    (3, 3, '2024-04-08', '2024-04-10', 'Patient stable after allergic reaction treatment'),
    (4, 4, '2024-04-08', '2024-04-10', 'Patient undergoing intensive care for car accident injuries'),
    (5, 5, '2024-04-08', '2024-04-10', 'Patient responding well to stroke treatment'),
    (6, 6, '2024-04-08', '2024-04-10', 'Patient recovering from seizure episode'),
    (7, 7, '2024-04-08', '2024-04-10', 'Patient receiving psychiatric evaluation after suicide attempt');
