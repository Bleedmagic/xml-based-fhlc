import random
import xml.etree.ElementTree as ET

# Load faculty.xml
faculty_tree = ET.parse("faculty.xml")
faculty_root = faculty_tree.getroot()

# Extract teacher names from faculty.xml
teacher_elements = faculty_root.findall(".//teacher")
teacher_names = [
    t.find("name").text for t in teacher_elements if t.find("name") is not None
]

# Sample data pools
section_names = [
    "Maple",
    "Oak",
    "Birch",
    "Pine",
    "Cedar",
    "Elm",
    "Aspen",
    "Spruce",
    "Willow",
    "Chestnut",
    "Fir",
    "Redwood",
    "Poplar",
    "Sequoia",
    "Sycamore",
    "Walnut",
    "Beech",
    "Hickory",
    "Alder",
    "Magnolia",
]

grade_levels = ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"]

schedules = [
    "Monday to Friday, 7:30 AM - 12:00 PM",
    "Monday to Friday, 8:00 AM - 12:30 PM",
    "Monday to Friday, 1:00 PM - 5:30 PM",
    "Monday to Friday, 7:30 AM - 1:00 PM",
    "Monday to Friday, 8:30 AM - 12:30 PM",
]


def generate_number_of_students():
    return str(random.randint(20, 35))


root = ET.Element("sections")

for i in range(25):
    section = ET.SubElement(root, "section")

    name = section_names[i % len(section_names)] + (
        f" {i // len(section_names) + 1}" if i >= len(section_names) else ""
    )
    ET.SubElement(section, "name").text = name

    grade_level = grade_levels[i % len(grade_levels)]
    ET.SubElement(section, "grade_level").text = grade_level

    adviser = random.choice(teacher_names)
    ET.SubElement(section, "adviser").text = adviser

    ET.SubElement(section, "number_of_students").text = generate_number_of_students()

    schedule = schedules[i % len(schedules)]
    ET.SubElement(section, "schedule").text = schedule

tree = ET.ElementTree(root)
tree.write("sections_gen.xml", encoding="UTF-8", xml_declaration=True)

print("XML file 'sections_gen.xml' generated successfully.")
