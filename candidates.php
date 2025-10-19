<?php
require_once 'core/lang.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: auth');
    exit();
}

// If role is not set or is not 'user' or 'admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
    header('Location: core/logout');
    exit();
}

include 'includes/header.php';
?>
    <div class="candidates-container">
        <div class="header">
        <h1>List of candidates:</h1>
        <div class="election-type">
            Election type: <span class="highlight">Student Council</span>
        </div>
        </div>

        <!-- President Position -->
        <div class="candidates-list">
        <div class="position-header">PRESIDENT</div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Zain el abidine Bou oubaid" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Zain el abidine Bou oubaid</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">S.N.E.M</div>
                <div class="badge">🚗</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                A dedicated student leader with a passion for innovation and community building. Experienced in organizing campus events and advocating for student rights. Committed to creating a more inclusive and engaging university environment.
                </div>
            </div>
            </div>
        </div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Sadam Hussain" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Sadam Hussain</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">U.N.E.M</div>
                <div class="badge">🔔</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                Passionate about student welfare and academic excellence. Has served on multiple student committees and brings fresh perspectives to campus governance. Focused on improving communication between students and administration.
                </div>
            </div>
            </div>
        </div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Aymen Mad haani" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Aymen Mad haani</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">S.N.E.M</div>
                <div class="badge">🚗</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                A second-year university student passionate about programming and technology, with knowledge of several well-known programming languages such as C++, Python, Java, JavaScript, and PHP. Possesses strong analytical and problem-solving skills. Is fluent in Arabic both written and spoken, and has a good understanding of foreign languages. Continually strives to develop his skills and participate in technical projects and challenges that enhance his practical experience.
                </div>
            </div>
            </div>
        </div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Sidi Aly" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Sidi Aly</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">U.G.E.M</div>
                <div class="badge">🏛️</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                An advocate for diversity and inclusion on campus. Experienced in student government and committed to representing all voices. Focused on sustainability initiatives and improving campus facilities for all students.
                </div>
            </div>
            </div>
        </div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Ahmad Mad Abba" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Ahmad Mad Abba</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">U.N.E.M</div>
                <div class="badge">🔔</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                Dedicated to enhancing student life through better resources and support systems. Has a track record of successful project management and team leadership. Committed to transparency and accountability in student governance.
                </div>
            </div>
            </div>
        </div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Mostafa Taleb" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Mostafa Taleb</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">S.N.E.M</div>
                <div class="badge">🚗</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                A visionary leader with innovative ideas for campus improvement. Experienced in organizing large-scale events and fostering community engagement. Committed to making the university experience memorable and meaningful for all students.
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Vice President Position -->
        <div class="candidates-list">
        <div class="position-header">VICE PRESIDENT</div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Candidate Name" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Candidate Name</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">ORG</div>
                <div class="badge">📋</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                Candidate biography and platform details will be added here.
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Presidential Election -->
        <div class="header" style="margin-top: 60px;">
        <div class="election-type">
            Election type: <span class="highlight">Presidential Election</span>
        </div>
        </div>

        <div class="candidates-list">
        <div class="position-header">PRESIDENT</div>

        <div class="candidate-card" onclick="toggleCandidate(this)">
            <div class="candidate-header">
            <img src="/placeholder.svg?height=60&width=60" alt="Candidate Name" class="candidate-photo">
            <div class="candidate-info">
                <div class="candidate-name">Candidate Name</div>
            </div>
            <div class="candidate-meta">
                <div class="organization">ORG</div>
                <div class="badge">🎯</div>
            </div>
            </div>
            <div class="candidate-details">
            <div class="candidate-details-inner">
                <div class="candidate-bio">
                Candidate biography and platform details will be added here.
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
<script src="assets/js/utilities/utils.js" defer></script>
<script src="assets/js/pages/candidates.js" defer></script>

<?php include 'includes/footer.php'; ?>
