// Initialisation du composant "sortable"
$(obj).sortable({
    axis: "y", // Le sortable ne s'applique que sur l'axe vertical
    containment: ".pluginList", // Le drag ne peut sortir de l'élément qui contient la liste
    handle: ".item", // Le drag ne peut se faire que sur l'élément .item (le texte)
    distance: 10, // Le drag ne commence qu'à partir de 10px de distance de l'élément
    // Evenement appelé lorsque l'élément est relaché
    stop: function(event, ui){
        // Pour chaque item de liste
        $(obj).find("li").each(function(){
            // On actualise sa position
            index = parseInt($(this).index()+1);
            // On la met à jour dans la page
            $(this).find(".count").text(index);
        });
    }
});

// On ajoute l'élément Poubelle à notre liste
$(obj).after("<div class='trash'>Trash</div>");
// On ajoute un petit formulaire pour ajouter des items
$(obj).after("<div class='add'><input class='addValue' /> <input type='button' value='Add' class='addBtn' /></div>")


// Bouton ajouter
$(".addBtn").click(function(){
    // Si le texte n'est pas vide
    if($(".addValue").val() != "")
    {
        // On ajoute un nouvel item à notre liste
        $(obj).append('<li>'+$(".addValue").val()+'</li>');
        // On réinitialise le champ de texte pour l'ajout
        $(".addValue").val("");
        // On ajoute les contrôles à notre nouvel item
        addControls($(obj).find("li:last-child"));
    }
})
// On autorise également la validation de la saisie d'un nouvel item par pression de la touche entrée
$(".addValue").live("keyup", function(e) {
    if(e.keyCode == 13) {
        // On lance l'évènement click associé au bouton d'ajout d'item
        $(".addBtn").trigger("click");
    }
});


$(".trash").droppable({
    // Lorsque l'on passe un élément au dessus de la poubelle
    over: function(event, ui){
        // On ajoute la classe "hover" au div .trash
        $(this).addClass("hover");
        // On cache l'élément déplacé
        ui.draggable.hide();
        // On indique via un petit message si l'on veut bien supprimer cet élément
        $(this).text("Remove "+ui.draggable.find(".item").text());
        // On change le curseur
        $(this).css("cursor", "pointer");
    },
    // Lorsque l'on quitte la poubelle
    out: function(event, ui){
        // On retire la classe "hover" au div .trash
        $(this).removeClass("hover");
        // On réaffiche l'élément déplacé
        ui.draggable.show();
        // On remet le texte par défaut
        $(this).text("Trash");
        // Ainsi que le curseur par défaut
        $(this).css("cursor", "normal");
    },
    // Lorsque l'on relache un élément sur la poubelle
    drop: function(event, ui){
        // On retire la classe "hover" associée au div .trash
        $(this).removeClass("hover");
        // On ajoute la classe "deleted" au div .trash pour signifier que l'élément a bien été supprimé
        $(this).addClass("deleted");
        // On affiche un petit message "Cet élément a été supprimé" en récupérant la valeur textuelle de l'élément relaché
        $(this).text(ui.draggable.find(".item").text()+" removed !");
        // On supprimer l'élément de la page, le setTimeout est un fix pour IE (http://dev.jqueryui.com/ticket/4088)
        setTimeout(function() { ui.draggable.remove(); }, 1);
 
        // On retourne à l'état originel de la poubelle après 2000 ms soit 2 secondes
        elt = $(this);
        setTimeout(function(){ elt.removeClass("deleted"); elt.text("Trash"); }, 2000);
    }
})