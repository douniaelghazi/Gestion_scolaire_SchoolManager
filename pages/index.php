<?php
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<h2 style="margin-bottom: 24px; color: #1a1a2e;">🏠 Tableau de bord</h2>

<div class="dashboard-grid">

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/eleves/liste.php">
            <div class="dash-card">
                <div class="icon">👨‍🎓</div>
                <h5>Élèves</h5>
                <p class="dash-desc">Gérer les élèves</p>
            </div>
        </a>
    </div>

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/enseignants/liste.php">
            <div class="dash-card">
                <div class="icon">👨‍🏫</div>
                <h5>Enseignants</h5>
                <p class="dash-desc">Gérer les enseignants</p>
            </div>
        </a>
    </div>

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/classes/liste.php">
            <div class="dash-card">
                <div class="icon">🏛️</div>
                <h5>Classes</h5>
                <p class="dash-desc">Gérer les classes</p>
            </div>
        </a>
    </div>

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/matieres/liste.php">
            <div class="dash-card">
                <div class="icon">📚</div>
                <h5>Matières</h5>
                <p class="dash-desc">Gérer les matières</p>
            </div>
        </a>
    </div>

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/affectations/liste.php">
            <div class="dash-card">
                <div class="icon">📋</div>
                <h5>Affectations</h5>
                <p class="dash-desc">Enseignant → Matière → Classe</p>
            </div>
        </a>
    </div>

    <div class="dash-card-wrap">
        <a href="/Gestion_scolaire_SchoolManager/pages/inscriptions/liste.php">
            <div class="dash-card">
                <div class="icon">📝</div>
                <h5>Inscriptions</h5>
                <p class="dash-desc">Élève → Classe</p>
            </div>
        </a>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
