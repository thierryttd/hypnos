currentDoc = document.location.pathname;
longPath = currentDoc.split('/');
currentDoc = longPath[longPath.length - 1];

switch (currentDoc){
    case 'bookingPeriod.php':
        document.forms[0].addEventListener('submit', function(evenement){
            // firstNight >= today
            // lastNight >= firstNIght
            d = new Date();
            year = d.getFullYear();
            month = d.getMonth();
            day = d.getDate();
            today = Date.parse(new Date(year, month, day));
            firstNight = Date.parse(new Date (document.getElementById('firstNight').value));
            lastNight = Date.parse(new Date(document.getElementById('lastNight').value));
                if( (lastNight < firstNight) || (firstNight < today) ){
                        evenement.preventDefault();
                        alert('Vérifier la cohérence des dates !');
                    }
            })
        break;
    case 'userCreate.php':
        document.getElementById('checkNumber1').value = Math.floor(Math.random() * (50 - 10) + 10);
        document.getElementById('checkNumber2').value = Math.floor(Math.random() * (50 - 10) + 10);
        checkSum = document.getElementById('checkSum');
        document.forms.formCheck.addEventListener('submit', function(evenement){
            checkSum = parseInt(document.getElementById('checkSum').value, 10);
            checkNumber1 = parseInt(document.getElementById('checkNumber1').value, 10);
            checkNumber2 = parseInt(document.getElementById('checkNumber2').value, 10);
            if (checkSum !== (checkNumber1 + checkNumber2) ){
                evenement.preventDefault();
                alert('La somme de contrôle n\'est pas conforme.');
            }
        })
        break;
    case 'userChangePw.php':
        newPw = document.getElementById('newPw');
        checkPw = document.getElementById('checkPw');
        document.forms.formChangePw.addEventListener('submit', function(evenement){
            if (newPw.value !== checkPw.value){
                evenement.preventDefault();
                alert('Vérifiez votre saisie du nouveau mot de passe.');
            }
        })
        break;
    case 'suiteGallery.php':
        ctrl = document.getElementById('formCheck');
        if(typeof(ctrl) != 'undefined' && ctrl != null){
            document.forms.formCheck.addEventListener('submit', function(evenement){
                nbrCheck = 0;
                postString = "";
                postFeatured = "";
                postCancel = "";
                problem = 0;
                featuredGallery=document.getElementsByClassName('featuredGallery');
                cancelGallery=document.getElementsByClassName('cancelGallery');

                // check all the checkbox (featuredGallery and cancelGallery length are the same)
                    for(i=0; i < featuredGallery.length; i++){
                        itemFeatured = document.getElementById(featuredGallery[i].id);
                        itemCancel = document.getElementById(cancelGallery[i].id);
                        if (itemFeatured.checked == true && itemCancel.checked == true){
                            problem = 1;
                        }
                        if (itemFeatured.checked == true){
                            galleries = itemFeatured.id.split("-");
                            postFeatured = galleries[1];
                            nbrCheck++;
                        }
                        if (itemCancel.checked == true){
                            galleries = itemCancel.id.split("-");
                            postCancel = postCancel + galleries[1] + ",";
                        }
                    }

                    if (nbrCheck > 1){
                        problem = 2;
                    }
                    switch(problem){
                        case 0:
                            postdata = document.getElementById('postString');
                            postdata.value = postFeatured + "-" + postCancel;
                            break;
                        case 1:
                            alert('Deux coches actives pour une image, ce n\'est pas autorisé');
                            evenement.preventDefault();
                            break;
                        case 2:
                            alert('Plus de une image definie par défaut');
                            evenement.preventDefault();
                            break;
                    }
            })
        }
    break;
}