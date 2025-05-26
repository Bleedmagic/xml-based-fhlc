import random
from datetime import datetime, timedelta
import xml.etree.ElementTree as ET

# Sample data pools
names = [
    "Maria Santos", "Aling Rosario", "Ana Dizon", "Domingo Navarro", "Rosalinda Villanueva",
    "Carmela Bautista", "Fernando Aguilar", "Eduardo Tan", "Veronica Reyes", "Isabel De Leon",
    "Ramon Castillo", "Minerva Lopez", "Estrella Mendoza", "Enrico Salazar", "Dolores Garcia",
    "Leticia Flores", "Andres Pascual", "Benito Francisco", "Luningning Javier", "Lourdes Perez",
    "Cristina Aquino", "Juan Dela Cruz", "Maria Clara", "Jose Rizal", "Emilio Aguinaldo"
]

subjects = [
    "Homework Difficulty", "Classroom Supplies", "Field Trip Approval", "Bullying Incident",
    "Grade Discrepancy", "Parent-Teacher Meeting", "School Bus Delay", "Technology Upgrade",
    "Unclear Instructions", "Extra-curricular Funding", "Noise in Classroom", "Library Books",
    "Inconsistent Attendance Records", "Professional Development", "Lunch Quality",
    "Sports Equipment", "Website Downtime", "Classroom Assistants", "Transportation Safety",
    "Classroom Renovation", "Insufficient Feedback", "New Computer Lab"
]

messages = [
    "The homework is too challenging for my child.",
    "Requesting more supplies for science experiments.",
    "Requesting approval for an educational field trip.",
    "Concern about bullying in the classroom.",
    "Discrepancy noticed in recent test grades.",
    "Request to schedule additional meetings for progress discussion.",
    "Frequent delays in the school bus schedule.",
    "Requesting updated computers for the classroom.",
    "Homework instructions are unclear and confusing.",
    "Request for additional funding for extra-curricular activities.",
    "Classroom noise level affects learning environment.",
    "Request to purchase new books for the library.",
    "Attendance records seem inconsistent with actual attendance.",
    "Request for training workshops for teachers.",
    "Concerns about the quality of school lunches.",
    "Request to update sports equipment for physical education.",
    "Portal is frequently inaccessible.",
    "Requesting additional teaching assistants.",
    "Concerns about bus safety standards.",
    "Request for classroom repainting and repairs.",
    "Not receiving enough feedback on child's progress.",
    "Request to set up a new computer lab for students."
]

statuses = ["Open", "Closed"]
vias = ["Contact", "Dashboard"]

def generate_email(name):
    return name.lower().replace(" ", ".") + "@gmail.com"

def generate_date(start_date, offset_days):
    date = start_date + timedelta(days=offset_days)
    return date.strftime("%Y-%m-%d")

root = ET.Element("submissions")

start_date = datetime(2025, 5, 1)

for i in range(1, 101):
    submission = ET.SubElement(root, "submission")

    ET.SubElement(submission, "id").text = str(i)
    via = random.choice(vias)
    ET.SubElement(submission, "via").text = via

    name = names[(i-1) % len(names)]
    ET.SubElement(submission, "submitted_by").text = name
    ET.SubElement(submission, "email").text = generate_email(name)

    ET.SubElement(submission, "submitted_date").text = generate_date(start_date, i-1)

    subject = subjects[(i-1) % len(subjects)]
    ET.SubElement(submission, "subject").text = subject

    message = messages[(i-1) % len(messages)]
    ET.SubElement(submission, "message").text = message

    status = random.choice(statuses)
    ET.SubElement(submission, "status").text = status

tree = ET.ElementTree(root)
tree.write("submissions_gen.xml", encoding="UTF-8", xml_declaration=True)

print("XML file 'submissions_gen.xml' generated successfully.")
