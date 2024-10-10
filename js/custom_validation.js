$(document).ready(function() {
    // Fonction de validation pour le champ club principal
    $('#club_principal').on('change', function() {
        console.log('Club principal changé :', $(this).val()); // Ajout pour vérifier le changement
        if ($(this).val() === '') {
            $('#club_principal-error').text('Veuillez sélectionner un club principal.');
        } else {
            $('#club_principal-error').text('');
        }
    });

    // Vérifier si le club principal est sélectionné lors de la soumission du formulaire
    $('form').on('submit', function(e) {
        console.log('Valeur du club principal à la soumission :', $('#club_principal').val()); // Ajout pour voir la valeur à la soumission
        if ($('#club_principal').val() === '') {
            e.preventDefault(); // Empêche la soumission du formulaire
            $('#club_principal-error').text('Veuillez sélectionner un club principal.');
        }
    });
});
