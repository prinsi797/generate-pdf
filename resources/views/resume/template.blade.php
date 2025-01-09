<!-- resources/views/resume/template.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #3498db;
            margin-top: 20px;
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 25px;
        }
        .education-item, .experience-item {
            margin-bottom: 15px;
        }
        .skill-item, .language-item, .certification-item {
            display: inline-block;
            background: #f0f0f0;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 3px;
        }
        .company-name {
            font-weight: bold;
        }
        .duration {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="resume">
        <!-- Header -->
        <h1>{{ $resume->full_name }}</h1>
        
        <!-- Contact Information -->
        <div class="contact-info">
            <p>
                Email: {{ $resume->email }} | 
                Phone: {{ $resume->phone }} |
                Address: {{ $resume->address }}
            </p>
        </div>

        <!-- Professional Summary -->
        <div class="section">
            <h2>Professional Summary</h2>
            <p>{{ $resume->professional_summary }}</p>
        </div>

        <!-- Experience -->
        <div class="section">
            <h2>Professional Experience</h2>
            @foreach($resume->experience as $exp)
            <div class="experience-item">
                <div class="company-name">{{ $exp['company'] }} - {{ $exp['position'] }}</div>
                <div class="duration">{{ $exp['duration'] }}</div>
                <p>{{ $exp['description'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Education -->
        <div class="section">
            <h2>Education</h2>
            @foreach($resume->education as $edu)
            <div class="education-item">
                <div class="company-name">{{ $edu['institution'] }}</div>
                <div>{{ $edu['degree'] }} - {{ $edu['year'] }}</div>
            </div>
            @endforeach
        </div>

        <!-- Skills -->
        <div class="section">
            <h2>Skills</h2>
            @foreach($resume->skills as $skill)
            <span class="skill-item">{{ $skill }}</span>
            @endforeach
        </div>

        <!-- Languages -->
        <div class="section">
            <h2>Languages</h2>
            @foreach($resume->languages as $language)
            <span class="language-item">{{ $language }}</span>
            @endforeach
        </div>

        <!-- Certifications -->
        @if(!empty($resume->certifications))
        <div class="section">
            <h2>Certifications</h2>
            @foreach($resume->certifications as $cert)
            <span class="certification-item">{{ $cert }}</span>
            @endforeach
        </div>
        @endif
    </div>
</body>
</html>