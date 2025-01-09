<!-- resources/views/resume/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .add-more-btn {
            margin-top: 10px;
        }
        .remove-btn {
            margin-top: 32px;
        }
        .section-title {
            color: #0d6efd;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            padding: 10px 30px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-5">Resume Generator</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resume.store') }}" method="POST">
        @csrf

        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="section-title">Personal Information</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Professional Summary</label>
                    <textarea class="form-control" name="professional_summary" rows="4" required>{{ old('professional_summary') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="form-section">
            <h3 class="section-title">Education</h3>
            <div id="education-container">
                <div class="education-entry">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Institution</label>
                            <input type="text" class="form-control" name="education[0][institution]" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Degree</label>
                            <input type="text" class="form-control" name="education[0][degree]" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Graduation Year</label>
                            <input type="number" class="form-control" name="education[0][year]" min="1900" max="2099" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary add-more-btn" onclick="addEducation()">
                <i class="bi bi-plus-circle"></i> Add More Education
            </button>
        </div>

        <!-- Experience -->
        <div class="form-section">
            <h3 class="section-title">Work Experience</h3>
            <div id="experience-container">
                <div class="experience-entry">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="experience[0][company]" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" name="experience[0][position]" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" class="form-control" name="experience[0][duration]" placeholder="e.g., 2020-2023" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Responsibilities & Achievements</label>
                            <textarea class="form-control" name="experience[0][description]" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary add-more-btn" onclick="addExperience()">
                <i class="bi bi-plus-circle"></i> Add More Experience
            </button>
        </div>

        <!-- Technical Skills -->
        <div class="form-section">
            <h3 class="section-title">Technical Skills</h3>
            <div id="skills-container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skill</label>
                        <input type="text" class="form-control" name="skills[]" placeholder="e.g., JavaScript" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary add-more-btn" onclick="addSkill()">
                <i class="bi bi-plus-circle"></i> Add More Skills
            </button>
        </div>

        <!-- Languages -->
        <div class="form-section">
            <h3 class="section-title">Languages</h3>
            <div id="languages-container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Language</label>
                        <input type="text" class="form-control" name="languages[]" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Proficiency Level</label>
                        <select class="form-select" name="language_levels[]" required>
                            <option value="Native">Native</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Basic">Basic</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary add-more-btn" onclick="addLanguage()">
                <i class="bi bi-plus-circle"></i> Add More Languages
            </button>
        </div>

        <!-- Certifications -->
        <div class="form-section">
            <h3 class="section-title">Certifications</h3>
            <div id="certifications-container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Certification Name</label>
                        <input type="text" class="form-control" name="certifications[]">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Issuing Organization</label>
                        <input type="text" class="form-control" name="certification_organizations[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" class="form-control" name="certification_years[]" min="1900" max="2099">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary add-more-btn" onclick="addCertification()">
                <i class="bi bi-plus-circle"></i> Add More Certifications
            </button>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-file-earmark-pdf"></i> Generate PDF Resume
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let educationCount = 1;
let experienceCount = 1;

function addEducation() {
    const container = document.getElementById('education-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'education-entry';
    newEntry.innerHTML = `
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Institution</label>
                <input type="text" class="form-control" name="education[${educationCount}][institution]" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Degree</label>
                <input type="text" class="form-control" name="education[${educationCount}][degree]" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Graduation Year</label>
                <input type="number" class="form-control" name="education[${educationCount}][year]" min="1900" max="2099" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-btn" onclick="this.parentElement.parentElement.parentElement.remove()">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newEntry);
    educationCount++;
}

function addExperience() {
    const container = document.getElementById('experience-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'experience-entry';
    newEntry.innerHTML = `
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" class="form-control" name="experience[${experienceCount}][company]" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" name="experience[${experienceCount}][position]" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Duration</label>
                <input type="text" class="form-control" name="experience[${experienceCount}][duration]" placeholder="e.g., 2020-2023" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Responsibilities & Achievements</label>
                <textarea class="form-control" name="experience[${experienceCount}][description]" rows="3" required></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-btn" onclick="this.parentElement.parentElement.parentElement.remove()">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newEntry);
    experienceCount++;
}

function addSkill() {
    const container = document.getElementById('skills-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'row';
    newEntry.innerHTML = `
        <div class="col-md-4 mb-3">
            <label class="form-label">Skill</label>
            <input type="text" class="form-control" name="skills[]" placeholder="e.g., JavaScript" required>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-btn" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newEntry);
}

function addLanguage() {
    const container = document.getElementById('languages-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'row';
    newEntry.innerHTML = `
        <div class="col-md-4 mb-3">
            <label class="form-label">Language</label>
            <input type="text" class="form-control" name="languages[]" required>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Proficiency Level</label>
            <select class="form-select" name="language_levels[]" required>
                <option value="Native">Native</option>
                <option value="Fluent">Fluent</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Basic">Basic</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-btn" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newEntry);
}

function addCertification() {
    const container = document.getElementById('certifications-container');
    const newEntry = document.createElement('div');
    newEntry.className = 'row';
    newEntry.innerHTML = `
        <div class="col-md-4 mb-3">
            <label class="form-label">Certification Name</label>
            <input type="text" class="form-control" name="certifications[]">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Issuing Organization</label>
            <input type="text" class="form-control" name="certification_organizations[]">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Year</label>
            <input type="number" class="form-control" name="certification_years[]" min="1900" max="2099">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-btn" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newEntry);
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = document.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
    }
});

// Clean up form fields when removed
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-btn')) {
        const section = e.target.closest('.row');
        if (section) {
            section.querySelectorAll('input, textarea, select').forEach(field => {
                field.value = '';
            });
        }
    }
});
</script>
</body>
</html>