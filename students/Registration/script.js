const facultyCourses = {
    ict: {
        semester1: ['BICT1101', 'BICT1102', 'BICT1103', 'BMAT1104', 'BLAN1105', 'BCWV1106'],
        semester2: ['BICT1201', 'BICT1202', 'BICT1203', 'BMAT1204', 'BLAN1205', 'BCWV1206'],
        semester5: {
            core: ['BICT3101', 'BICT3102'],
            majors: {
                "Software Engineering": ['BSSE3103', 'BSSE3104', 'BSSE3105'],
                "Network Engineering": ['BSNE3201', 'BSNE3202', 'BSNE3203']
            }
        },
        // Add remaining semesters
    },
    nursing: {
        semester1: ['OSCE', 'BNUR1102', 'BNUR1103', 'BMAT1104', 'BPHY1105'],
        // Add remaining semesters
    },
    commerce: {
        semester1: ['BCOM1101', 'BCOM1102', 'BCOM1103', 'BECO1104', 'BLAN1105'],
        // Add remaining semesters
    }
};

document.getElementById('faculty').addEventListener('change', function() {
    const faculty = this.value;
    const semester = document.getElementById('semester').value;
    
    if (faculty && semester) {
        populateCourses(faculty, semester);
    }
});

document.getElementById('semester').addEventListener('change', function() {
    const faculty = document.getElementById('faculty').value;
    const semester = this.value;

    if (faculty && semester) {
        populateCourses(faculty, semester);
    }
});

function populateCourses(faculty, semester) {
    const coursesList = document.getElementById('coursesList');
    const coursesContainer = document.getElementById('coursesContainer');

    coursesList.innerHTML = ''; // Clear the previous courses

    const courses = facultyCourses[faculty][semester];

    if (Array.isArray(courses)) {
        coursesContainer.style.display = 'block';
        courses.forEach(course => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'courses[]';
            checkbox.value = course;

            const label = document.createElement('label');
            label.textContent = course;

            const br = document.createElement('br');

            coursesList.appendChild(checkbox);
            coursesList.appendChild(label);
            coursesList.appendChild(br);
        });
    } else if (typeof courses === 'object') {
        // Handle majors if applicable (you can create another dropdown for majors)
    }
}

function cancelForm() {
    document.getElementById('registrationForm').reset();
    document.getElementById('coursesContainer').style.display = 'none';
}
