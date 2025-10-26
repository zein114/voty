function closeModal() {
    const modal = document.getElementById('modal');

    modal.classList.remove('active');
    modal.innerHTML = ``;
}

function stopElection(electionId, lang) {
    const modal = document.getElementById('modal');

    
    const langs = {
        ar: {
            stopElection: "هل أنت متأكد من إيقاف هذه الانتخابات؟",
            yesbtn: "نعم، أنا متأكد",
            nobtn: "لا، سأعود للخلف",
        },
        en: {
            stopElection: 'Are you Sure about Stopping this Election',
            yesbtn: 'Yes, I\'m sure',
            nobtn: 'No, I Will Go Back',
        },
        fr: {
            stopElection: "Êtes-vous sûr de vouloir arrêter cette élection ?",
            yesbtn: "Oui, j'en suis sûr",
            nobtn: "Non, je vais revenir en arrière",
        }
    };

    modal.innerHTML = `
        <span class="close-icon" onclick="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#06ac7d" stroke-width="2"/>
                <path d="M9 9L15 15M15 9L9 15" stroke="#06ac7d" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <span class="title-modal">${langs[`${lang}`].stopElection}</span>
        <div class="form">
            <button class="btn-form" id="btn-yes">${langs[`${lang}`].yesbtn}</button>
            <button class="btn-form" id="btn-no">${langs[`${lang}`].nobtn}</button>
        </div>
    `;
    modal.classList.add('active');

    const btnYes = document.getElementById('btn-yes');
    const btnNo = document.getElementById('btn-no');

    btnNo.addEventListener('click', function() {
        closeModal();
    });
    btnYes.addEventListener("click", function() {
        const formData = new FormData();
        formData.append('action', 'stopElection');
        formData.append('id_Election', electionId);

        fetch('../apis/api.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .catch(err => console.error('Error:', err));
        
        closeModal();
        window.location.reload();
    });
}

function addElection(lang) {
    const modal = document.getElementById('modal');

    const langs = {
        ar: {
            addElection: "إضافة انتخابات جديدة",
            nameOrganizerArabic: "اسم المنظم بالعربية",
            nameOrganizerEnglish: "اسم المنظم بالإنجليزية",
            nameOrganizerFrench: "اسم المنظم بالفرنسية",
            yearElection: "سنة الانتخابات",
            startElection: "تاريخ بدء الانتخابات",
            endElection: "تاريخ انتهاء الانتخابات",
            submitBtn: "إضافة",
            pleaseCompleteForm: "يرجى ملء النموذج بالكامل",
        },
        en: {
            addElection: 'Add new Election',
            nameOrganizerArabic: 'Name of Organizer in Arabic',
            nameOrganizerEnglish: 'Name of Organizer in English',
            nameOrganizerFrench: 'Name of Organizer in French',
            yearElection: 'Year Of Election',
            startElection: 'Election Start date',
            endElection: 'Election End date',
            submitBtn: 'Add',
            pleaseCompleteForm: 'Please fill out the Form Completely',
        },
        fr: {
            addElection: "Ajouter une nouvelle élection",
            nameOrganizerArabic: "Nom de l'organisateur en arabe",
            nameOrganizerEnglish: "Nom de l'organisateur en anglais",
            nameOrganizerFrench: "Nom de l'organisateur en français",
            yearElection: "Année de l'élection",
            startElection: "Date de début de l'élection",
            endElection: "Date de fin de l'élection",
            submitBtn: "Ajouter",
            pleaseCompleteForm: "Veuillez remplir complètement le formulaire",
        }
    };

    modal.innerHTML = `
        <span class="close-icon" onclick="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#06ac7d" stroke-width="2"/>
                <path d="M9 9L15 15M15 9L9 15" stroke="#06ac7d" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <span class="title-modal">${langs[`${lang}`].addElection}</span>
        <div class="form">
            <span id="error-form"></span>
            <div class="input-form">
                <label for="ar_organizer">${langs[`${lang}`].nameOrganizerArabic}</label>
                <input type="text" name="ar_organizer" id="ar_organizer" required>
            </div>
            <div class="input-form">
                <label for="en_organizer">${langs[`${lang}`].nameOrganizerEnglish}</label>
                <input type="text" name="en_organizer" id="en_organizer" required>
            </div>
            <div class="input-form">
                <label for="fr_organizer">${langs[`${lang}`].nameOrganizerFrench}</label>
                <input type="text" name="fr_organizer" id="fr_organizer" required>
            </div>
            <div class="input-form">
                <label for="year">${langs[`${lang}`].yearElection}</label>
                <input type="text" name="year" id="year" required>
            </div>
            <div class="input-form">
                <label for="date_start">${langs[`${lang}`].startElection}</label>
                <input type="date" name="date_start" id="date_start" required>
            </div>
            <div class="input-form">
                <label for="date_end">${langs[`${lang}`].endElection}</label>
                <input type="date" name="date_end" id="date_end" required>
            </div>
            <button class="btn-form" id="btn-form">${langs[`${lang}`].submitBtn}</button>
        </div>
    `;
    modal.style.left = '35%';
    modal.classList.add('active');

    const btnForm = document.getElementById('btn-form');
    const errorSpan = document.getElementById('error-form');
    errorSpan.style.color = '#ff4444';

    btnForm.addEventListener('click', function() {
        const arNameOrganizer = document.getElementById('ar_organizer').value;
        const enNameOrganizer = document.getElementById('en_organizer').value;
        const frNameOrganizer = document.getElementById('fr_organizer').value;
        const yearOrganizer = document.getElementById('year').value;
        const startAt = document.getElementById('date_start').value;
        const endAt = document.getElementById('date_end').value;

        if(arNameOrganizer == '' && enNameOrganizer == '' && frNameOrganizer == '' && yearOrganizer == '' && startAt == '' && endAt == '') {
            closeModal();
        } else if (arNameOrganizer == '' || enNameOrganizer == '' || frNameOrganizer == '' || yearOrganizer == '' || startAt == '' || endAt == '') {
            errorSpan.textContent = langs[`${lang}`].pleaseCompleteForm;
        } else {
            const formData = new FormData();
            formData.append('action', 'addElection');
            formData.append('ar_organizer', arNameOrganizer);
            formData.append('en_organizer', enNameOrganizer);
            formData.append('fr_organizer', frNameOrganizer);
            formData.append('year', yearOrganizer);
            formData.append('date_start', startAt);
            formData.append('date_end', endAt);

            fetch('../apis/api.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .catch(err => console.error('Error:', err));

            closeModal();
            window.location.reload();
        }
    });
}

function addNewCandidate(electionId, lang) {
    const modal = document.getElementById('modal');

    const langs = {
        ar: {
            addCandidate: 'إضافة مرشح جديد',
            nameCandidateArabic: 'اسم المرشح بالعربية',
            nameCandidate: 'اسم المرشح بالإنجليزية أو الفرنسية',
            descriptionArabic: 'وصف المرشح بالعربية',
            descriptionEnglish: 'وصف المرشح بالإنجليزية',
            descriptionFrench: 'وصف المرشح بالفرنسية',
            supportingParty: 'الحزب الداعم',
            photoCandidate: 'صورة المرشح',
            logoSupporting: 'شعار الحزب الداعم',
            position: 'المنصب',
            optionDescription: 'اختر المنصب...',
            submitBtn: 'إضافة',
            pleaseCompleteForm: 'يرجى ملء النموذج بالكامل',
        },
        en: {
            addCandidate: 'Add new Candidate',
            nameCandidateArabic: 'Name of Candidate in Arabic',
            nameCandidate: 'Name of Candidate in English or French',
            descriptionArabic: 'Description of Candidate in Arabic',
            descriptionEnglish: 'Description of Candidate in English',
            descriptionFrench: 'Description of Candidate in French',
            supportingParty: 'Supporting Party',
            photoCandidate: 'Photo for Candidate',
            logoSupporting: 'logo for Supporting party',
            position: 'Position',
            optionDescription: 'Select Position...',
            submitBtn: 'Add',
            pleaseCompleteForm: 'Please fill out the Form Completely',
        },
        fr: {
            addCandidate: 'Ajouter un nouveau candidat',
            nameCandidateArabic: 'Nom du candidat en arabe',
            nameCandidate: 'Nom du candidat en anglais ou en français',
            descriptionArabic: 'Description du candidat en arabe',
            descriptionEnglish: 'Description du candidat en anglais',
            descriptionFrench: 'Description du candidat en français',
            supportingParty: 'Parti soutenant',
            photoCandidate: 'Photo du candidat',
            logoSupporting: 'Logo du parti soutenant',
            position: 'Poste',
            optionDescription: 'Sélectionnez un poste...',
            submitBtn: 'Ajouter',
            pleaseCompleteForm: 'Veuillez remplir complètement le formulaire',
        }
    }

    modal.innerHTML = `
        <span class="close-icon" onclick="closeModal()" style="margin-top: -5%; margin-right: -105%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#06ac7d" stroke-width="2"/>
                <path d="M9 9L15 15M15 9L9 15" stroke="#06ac7d" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
<span class="title-modal">${langs[`${lang}`].addCandidate}</span>
        <span id="error-form"></span>
        <div class="form" style="display:grid; grid-template-columns: 1fr 1fr; gap: 2vh;">
            <div class="input-form">
                <label for="ar_name">${langs[`${lang}`].nameCandidateArabic}</label>
                <input type="text" name="ar_name" id="ar_name" required>
            </div>
            <div class="input-form">
                <label for="name">${langs[`${lang}`].nameCandidate}</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="input-form">
                <label for="ar_description">${langs[`${lang}`].descriptionArabic}</label>
                <input type="text" name="ar_description" id="ar_description" required>
            </div>
            <div class="input-form">
                <label for="en_description">${langs[`${lang}`].descriptionEnglish}</label>
                <input type="text" name="en_description" id="en_description" required>
            </div>
            <div class="input-form">
                <label for="fr_description">${langs[`${lang}`].descriptionFrench}</label>
                <input type="text" name="fr_description" id="fr_description" required>
            </div>
            <div class="input-form">
                <label for="supporting_party">${langs[`${lang}`].supportingParty}</label>
                <input type="text" name="supporting_party" id="supporting_party" required>
            </div>
            <div class="input-form">
                <label for="photo_candidate">${langs[`${lang}`].photoCandidate}</label>
                <input type="file" name="photo_candidate" id="photo_candidate" required>
            </div>
            <div class="input-form">
                <label for="logo_supproting">${langs[`${lang}`].logoSupporting}</label>
                <input type="file" name="logo_supproting" id="logo_supproting" required>
            </div>
            <div class="input-form" style="${(lang === 'ar')? 'margin-right:53%;' : 'margin-left:53%;'}">
                <label for="position">${langs[`${lang}`].position}</label>
                <select name="position" id="id_position" required>
                    <option value="">${langs[`${lang}`].optionDescription}</option>
                </select>
            </div>
        </div>
        <button class="btn-form" id="btn-form">${langs[`${lang}`].submitBtn}</button>
    `;

    const selectPosition = document.getElementById('id_position');
    
    fetch(`../apis/api.php?action=getAllPositions`)
    .then(res => res.json())
    .then(positions => {
        let name = lang+'_name';
        positions.forEach(position => {
            const option = document.createElement('option');
            option.value = position.id;
            option.textContent = position[`${name}`];
            selectPosition.appendChild(option);
        });
    });
    modal.style.left = '26%';
    modal.classList.add('active');

    const btnForm = document.getElementById('btn-form');
    const errorSpan = document.getElementById('error-form');
    errorSpan.style.color = '#ff4444';


    btnForm.addEventListener('click', function() {
        const arName = document.getElementById('ar_name').value;
        const Name = document.getElementById('name').value;
        const arDescription = document.getElementById('ar_description').value;
        const frDescription = document.getElementById('fr_description').value;
        const enDescription = document.getElementById('en_description').value;
        const supportingParty = document.getElementById('supporting_party').value;
        const photoCandidate = document.getElementById('photo_candidate');
        const logoSupporting = document.getElementById('logo_supproting');
        const positionId = document.getElementById('id_position').value;

        if(arName == '' && Name == '' && arDescription == '' && frDescription == '' && enDescription == '' && supportingParty == '' && photoCandidate.files['length'] === 0 && logoSupporting.files['length'] === 0 && positionId == '') {
            closeModal();
        } else if (arName == '' || Name == '' || arDescription == '' || frDescription == '' || enDescription == '' || supportingParty == '' || photoCandidate.files['length'] == 0 || logoSupporting.files['length'] == 0 || positionId == '') {
            errorSpan.textContent = langs[`${lang}`].pleaseCompleteForm;
        } else {
            const formData = new FormData();
            formData.append('action', 'addCandidate');
            formData.append('ar_name', arName);
            formData.append('name', Name);
            formData.append('ar_description', arDescription);
            formData.append('fr_description', frDescription);
            formData.append('en_description', enDescription);
            formData.append('supporting_party', supportingParty);
            formData.append('photo_candidate', photoCandidate.files[0]);
            formData.append('logo_supporting', logoSupporting.files[0]);
            formData.append('id_position', positionId);

            fetch('../apis/api.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => errorSpan.textContent = `Server Response: ${data}`)
            .catch(err => console.error('Error:', err));
            if (errorSpan.textContent === '') {
                closeModal();
            }
        }
    });
}

function addNewPosition(electionId, current_lang) {
    const modal = document.getElementById('modal');

    const langs = {
        ar: {
            addPosition: 'إضافة منصب جديد',
            namePositionArabic: 'اسم المنصب بالعربية',
            namePositionEnglish: 'اسم المنصب بالإنجليزية',
            namePositionFrench: 'اسم المنصب بالفرنسية',
            submitBtn: 'إضافة',
            pleaseCompleteForm: 'يرجى إكمال تعبئة النموذج بالكامل',
        },
        en: {
            addPosition: 'Add new Position',
            namePositionArabic: 'Name of Position in Arabic',
            namePositionEnglish: 'Name of Position in English',
            namePositionFrench: 'Name of Position in French',
            submitBtn: 'Add',
            pleaseCompleteForm: 'Please fill out the Form Completely',
        },
        fr: {
            addPosition: 'Ajouter un nouveau poste',
            namePositionArabic: 'Nom du poste en arabe',
            namePositionEnglish: 'Nom du poste en anglais',
            namePositionFrench: 'Nom du poste en français',
            submitBtn: 'Ajouter',
            pleaseCompleteForm: 'Veuillez remplir complètement le formulaire',
        }
    }

    modal.innerHTML = `
        <span class="close-icon" onclick="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#06ac7d" stroke-width="2"/>
                <path d="M9 9L15 15M15 9L9 15" stroke="#06ac7d" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <span class="title-modal">${langs[`${current_lang}`].addPosition}</span>
        <div class="form">
            <span id="error-form"></span>
            <div class="input-form">
                <label for="ar_name">${langs[`${current_lang}`].namePositionArabic}</label>
                <input type="text" name="ar_name" id="ar_name" required>
            </div>
            <div class="input-form">
                <label for="en_name">${langs[`${current_lang}`].namePositionEnglish}</label>
                <input type="text" name="en_name" id="en_name" required>
            </div>
            <div class="input-form">
                <label for="fr_name">${langs[`${current_lang}`].namePositionFrench}</label>
                <input type="text" name="fr_name" id="fr_name" required>
            </div>
            <button class="btn-form" id="btn-form">${langs[`${current_lang}`].submitBtn}</button>
        </div>
    `;
    modal.style.left = '36%';
    modal.classList.add('active');

    const btnForm = document.getElementById('btn-form');
    const errorSpan = document.getElementById('error-form');
    errorSpan.style.color = '#ff4444';

    btnForm.addEventListener('click', function() {
        const arName = document.getElementById('ar_name').value;
        const enName = document.getElementById('en_name').value;
        const frName = document.getElementById('fr_name').value;
        if(arName == '' && frName == '' && enName == '') {
            closeModal();
        } else if (arName == '' || frName == '' || enName == '') {
            errorSpan.textContent = langs[`${current_lang}`].pleaseCompleteForm;
        } else {
            const formData = new FormData();
            formData.append('action', 'addPosition');
            formData.append('ar_name', arName);
            formData.append('en_name', enName);
            formData.append('fr_name', frName);
            formData.append('id_election', electionId);

            fetch('../apis/api.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => errorSpan.textContent = `Server Response: ${data}`)
            .catch(err => console.error('Error:', err));

            closeModal();
        }
    });
}

function getListOfPositions(electionId, lang ) {
    const modal = document.getElementById('modal');

    const langs = {
        ar: {
            listPosition: "قائمة المناصب",
            thNumber: "الرقم",
            thName: "الاسم",
            noPositions: "لم يتم العثور على مناصب",
            closeBtn: "إغلاق",
        },
        en: {
            listPosition: 'List Of Positions',
            thNumber: 'Number',
            thName: 'Name',
            noPositions: 'Don\'t find Positions',
            closeBtn: 'close',
        },
        fr: {
            listPosition: "Liste des postes",
            thNumber: "Numéro",
            thName: "Nom",
            noPositions: "Aucun poste trouvé",
            closeBtn: "Fermer",
        }
    };
    modal.innerHTML = `
        <span class="close-icon" onclick="closeModal()" style="margin-right: -105%; margin-top: -7%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24" fill="none">
                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#06ac7d" stroke-width="2"/>
                <path d="M9 9L15 15M15 9L9 15" stroke="#06ac7d" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <span class="title-modal">${langs[`${lang}`].listPosition}</span>
        <table>
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody id="body-table">
                
            </tbody>
        </table>
        <button class="btn-form" onclick="closeModal()">${langs[`${lang}`].closeBtn}</button>
    `;
    modal.style.left = '35%';
    modal.classList.add('active');   

    const bodyTable = document.getElementById('body-table');

    fetch(`../apis/api.php?action=getPositionByElection&id_election=${electionId}`)
    .then(res => res.json())
    .then(positions => {
        if (positions.length == 0) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td colspan="2" style="color:#ff4444;">${langs[`${lang}`].noPositions}</td>
            `;
            bodyTable.appendChild(tr);
        } else {
            positions.forEach(position => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${position.id}</td>
                    <td>${position[`${lang}_name`]}</td>
                `;
                bodyTable.appendChild(tr);
            });

            if (bodyTable.lastElementChild) {
                bodyTable.lastElementChild.className = 'last-element';
            }
        }
    });
}

function publishResults(electionId) {
    const formData = new FormData();
    formData.append('action', 'publishResults');
    formData.append('id_election', electionId);

    fetch('../apis/api.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .catch(err => console.error('Error:', err));
    window.location.reload();
}

function stopPublishingResults(electionId) {
    const formData = new FormData();
    formData.append('action', 'stopPublishingResults');
    formData.append('id_election', electionId);

    fetch('../apis/api.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .catch(err => console.error('Error:', err));
    window.location.reload();
}

function getListOfCandidates(electionId) {
    window.location.href = `../admin/admin-candidates.php?id_election=${electionId}`;
}

function getResults(electionId) {
    window.location.href = `../admin/admin-results.php?id_election=${electionId}`;
}