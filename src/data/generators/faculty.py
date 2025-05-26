import random
import xml.etree.ElementTree as ET

# Sample data pools
teacher_names = [
    "Anna Reyes",
    "John Cruz",
    "Maria Santos",
    "Carlos Dela Rosa",
    "Lucia Mendoza",
    "Mark Villanueva",
    "Jennifer Lim",
    "Samuel Tan",
    "Grace Bautista",
    "Daniel Ramos",
    "Rosa Garcia",
    "Enrique Navarro",
    "Patricia Uy",
    "Adrian Flores",
    "Sophia Martinez",
    "Francis Chua",
    "Isabelle Torres",
    "Leo Gutierrez",
    "Theresa Diaz",
    "Allan David",
    "Jasmine Ong",
    "Victor Santos",
    "Elaine Rivera",
    "Nathaniel Perez",
    "Bianca Robles",
]

subject_options = [
    ["Mathematics", "Science"],
    ["English", "Reading"],
    ["Filipino", "Araling Panlipunan"],
    ["Science"],
    ["Music", "Arts"],
    ["Mathematics"],
    ["English"],
    ["Physical Education"],
    ["Reading", "Filipino"],
    ["Araling Panlipunan"],
    ["Science", "Health"],
    ["English", "Mathematics"],
    ["Art"],
    ["Music"],
    ["Mathematics", "Science"],
    ["Computer Education"],
    ["Filipino", "Reading"],
    ["English"],
    ["Mathematics"],
    ["Science", "Health"],
    ["English", "Reading"],
    ["Filipino", "Araling Panlipunan"],
    ["Art", "Music"],
    ["Computer Education"],
    ["Science"],
]

grade_levels_options = [
    "Kinder, Grade 1",
    "Grade 2, Grade 3",
    "Grade 4, Grade 5",
    "Grade 6",
    "Kinder, Grade 1, Grade 2",
    "Grade 3, Grade 4",
    "Grade 5, Grade 6",
    "Kinder to Grade 6",
    "Grade 1, Grade 2",
    "Grade 3, Grade 4",
    "Grade 5, Grade 6",
    "Kinder, Grade 1",
    "Grade 2, Grade 3",
    "Grade 4 to Grade 6",
    "Grade 2, Grade 5",
    "Grade 3 to Grade 6",
    "Grade 1, Grade 2",
    "Grade 4 to Grade 6",
    "Kinder to Grade 3",
    "Grade 5, Grade 6",
    "Grade 1 to Grade 3",
    "Grade 4 to Grade 6",
    "Kinder to Grade 2",
    "Grade 1 to Grade 6",
    "Grade 3 to Grade 6",
]

types = ["Full Time", "Part Time"]

root = ET.Element("faculty")
teachers = ET.SubElement(root, "teachers")

num_teachers = 50

for i in range(num_teachers):
    teacher = ET.SubElement(teachers, "teacher")
    tid = f"T{i + 1:03d}"
    ET.SubElement(teacher, "id").text = tid

    name = random.choice(teacher_names)
    ET.SubElement(teacher, "name").text = name

    subjects = ", ".join(random.choice(subject_options))
    ET.SubElement(teacher, "subject_handled").text = subjects

    grade_levels = random.choice(grade_levels_options)
    ET.SubElement(teacher, "grade_levels").text = grade_levels

    ttype = random.choice(types)
    ET.SubElement(teacher, "type").text = ttype

tree = ET.ElementTree(root)
tree.write("faculty_gen.xml", encoding="UTF-8", xml_declaration=True)

print("XML file 'faculty_gen.xml' generated successfully.")
