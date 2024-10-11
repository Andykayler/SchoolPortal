const facultyCourses = {
    ict: {
        // semester1: [],
        semester2: ['BICT1201', 'BICT1202', 'BICT1203', 'BMAT1204', 'BLAN1205', 'BCWV1206'],
        semester3: ['BICT2101', 'BSOC2102', 'BICT2103', 'BICT2104', 'BICT1205'],
        semester5: {
            core: ['BICT3101', 'BICT3102'],
            majors: {
                "Software Engineering": ['BSSE3103', 'BSSE3104', 'BSSE3105'],
                "Network Engineering": ['BSNE3201', 'BSNE3202', 'BSNE3203']
            }
        }
    },
    // Add other faculties here
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

    coursesList.innerHTML = ''; // Clear previous courses
    coursesContainer.style.display = 'none'; // Hide courses initially

    const courses = facultyCourses[faculty] && facultyCourses[faculty][semester];

    if (!courses) {
        return; // Return if no courses available for the selected semester
    }

    if (Array.isArray(courses)) {
        // Show courses directly
        coursesContainer.style.display = 'block';
        courses.forEach(course => {
            const button = document.createElement('button');
            button.className = 'tag-button';
            button.textContent = course;
            button.value = course;

            button.addEventListener('click', function() {
                this.classList.toggle('active');
                toggleCourseSelection(this.value);
            });

            coursesList.appendChild(button);
        });
    } else if (typeof courses === 'object') {
        // If the courses object has majors, handle it differently
        // (e.g., show a major selection dropdown first and then display related courses)
    }
}

function toggleCourseSelection(course) {
    const selectedCourses = document.getElementById('selectedCourses');
    const selected = document.querySelector(`input[name="courses[]"][value="${course}"]`);

    if (selected) {
        selected.remove(); // Remove course if already selected
    } else {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'courses[]';
        input.value = course;
        selectedCourses.appendChild(input); // Add hidden input to the form
    }
}
