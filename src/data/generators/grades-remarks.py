import xml.etree.ElementTree as ET
import random

# Load existing students.xml
tree = ET.parse("students.xml")
root = tree.getroot()

# Create root for grades-remarks
grades_remarks_root = ET.Element("grades-remarks")

for student in root.findall("student"):
    student_id = student.find("id").text
    student_name = student.find("name").text
    grade_level = student.find("grade").text

    # Generate a general average between 70 and 100
    general_average = random.randint(70, 100)
    remarks = "Passed" if general_average >= 75 else "Failed"

    student_elem = ET.SubElement(grades_remarks_root, "student")
    ET.SubElement(student_elem, "id").text = student_id
    ET.SubElement(student_elem, "name").text = student_name
    ET.SubElement(student_elem, "grade_level").text = grade_level
    ET.SubElement(student_elem, "general_average").text = str(general_average)
    ET.SubElement(student_elem, "remarks").text = remarks

# Write to grades-remarks.xml
grades_remarks_tree = ET.ElementTree(grades_remarks_root)
grades_remarks_tree.write("grades-remarks_gen.xml", encoding="UTF-8", xml_declaration=True)
