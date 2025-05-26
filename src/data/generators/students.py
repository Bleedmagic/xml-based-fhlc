import xml.etree.ElementTree as ET
import random

# Sample data pools
student_first_names = [
    "Juan",
    "Anna",
    "Mark",
    "Isabel",
    "Leo",
    "Trisha",
    "Enzo",
    "Sofia",
    "Paolo",
    "Kathleen",
    "Diego",
    "Mae",
    "Lance",
    "Nadine",
    "Carlo",
    "Ella",
    "Miguel",
    "Bea",
    "Josh",
    "Alexis",
    "Nico",
    "Clarisse",
    "Jared",
    "Faith",
    "Kyle",
]

surnames = [
    "Dela Cruz",
    "Santos",
    "Reyes",
    "Garcia",
    "Mendoza",
    "Cruz",
    "Lim",
    "Torres",
    "Ramos",
    "Ong",
    "Fernandez",
    "Villanueva",
    "Navarro",
    "Co",
    "Uy",
    "Chua",
    "Tan",
    "Mercado",
    "Bautista",
    "Sy",
    "Sison",
    "Dy",
    "Aquino",
    "Lao",
    "Manalo",
]

guardian_first_names = [
    "Maria",
    "Jose",
    "Carmen",
    "Pedro",
    "Luz",
    "Andres",
    "Luisa",
    "Antonio",
    "Teresa",
    "Rafael",
    "Gloria",
    "Manuel",
    "Angelica",
    "Mario",
    "Elena",
    "Ricardo",
    "Dolores",
    "Tomas",
    "Victoria",
    "Eduardo",
    "Camille",
    "Helen",
    "Joseph",
    "Rosa",
    "Samuel",
]

grades = ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"]
sections = ["Rizal", "Luna", "Mabini", "Bonifacio", "Del Pilar", "Lapu-Lapu"]
statuses = ["Active", "Inactive"]

root = ET.Element("students")

for i in range(240):
    student = ET.SubElement(root, "student")
    student_id = f"485563-{i + 1:03d}"
    ET.SubElement(student, "id").text = student_id

    # Student name
    student_first = random.choice(student_first_names)
    student_surname = random.choice(surnames)
    full_name = f"{student_first} {student_surname}"
    ET.SubElement(student, "name").text = full_name

    # Guardian name, maybe share surname
    guardian_first = random.choice(guardian_first_names)
    if random.random() < 0.6:
        guardian_surname = student_surname
    else:
        guardian_surname = random.choice([s for s in surnames if s != student_surname])
    guardian_name = f"{guardian_first} {guardian_surname}"
    ET.SubElement(student, "guardian_name").text = guardian_name

    # Guardian contact (random but valid format)
    contact_number = f"09{random.randint(1, 9)}{random.randint(100000000, 999999999)}"
    ET.SubElement(student, "guardian_contact").text = contact_number

    ET.SubElement(student, "grade").text = random.choice(grades)
    ET.SubElement(student, "section").text = random.choice(sections)
    ET.SubElement(student, "status").text = random.choice(statuses)

tree = ET.ElementTree(root)
output_path = "students_gen.xml"
tree.write(output_path, encoding="UTF-8", xml_declaration=True)

output_path
