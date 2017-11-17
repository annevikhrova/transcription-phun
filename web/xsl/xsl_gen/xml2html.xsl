<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>



<xsl:template match="@*|node()">
                    <xsl:copy>   
                        <xsl:apply-templates select="@*|node()"/>
                    </xsl:copy>
                </xsl:template>


<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="descriptif">
    <span class="descriptif">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="fichier_image">
    <span class="fichier_image">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="cote_volume">
    <span class="cote_volume">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="proprietes_physiques">
    <span class="proprietes_physiques">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="transcripteur">
    <span class="transcripteur">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="domaine">
    <span class="domaine">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="corpus">
    <span class="corpus">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="document">
    <span class="document">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="nature_document">
    <span class="nature_document">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="date_redaction">
    <span class="date_redaction">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="date_redaction_page">
    <span class="date_redaction_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lieu_redaction">
    <span class="lieu_redaction">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lieu_redaction_page">
    <span class="lieu_redaction_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire_page">
    <span class="commentaire_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="contenu">
    <span class="contenu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="tableau">
    <span class="tableau">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="reclame">
    <span class="reclame">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="contre_reclame">
    <span class="contre_reclame">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ligne_de_tableau">
    <span class="ligne_de_tableau">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="cellule_de_tableau">
    <span class="cellule_de_tableau">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="figure">
    <span class="figure">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="pagination">
    <span class="pagination">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="foliotation">
    <span class="foliotation">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_en_interligne">
    <span class="bloc_en_interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="texte">
    <span class="texte">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="multimedia">
    <span class="multimedia">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="trait_de_separation">
    <span class="trait_de_separation">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="liste">
    <span class="liste">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="liste_2_colonnes">
    <span class="liste_2_colonnes">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ligne_de_liste">
    <span class="ligne_de_liste">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="titre">
    <span class="titre">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="sous_titre">
    <span class="sous_titre">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="titre_courant">
    <span class="titre_courant">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="paragraphe">
    <span class="paragraphe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_de_citation">
    <span class="bloc_de_citation">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ligne">
    <span class="ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="vers">
    <span class="vers">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="raturé">
    <span class="raturé">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="gras">
    <span class="gras">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="souligné">
    <span class="souligné">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="souligne_au_dessus">
    <span class="souligne_au_dessus">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="exposant">
    <span class="exposant">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="indice">
    <span class="indice">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="averifier">
    <span class="averifier">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="surcharge">
    <span class="surcharge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="interligne">
    <span class="interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="variante_en_interligne">
    <span class="variante_en_interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="date">
    <span class="date">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lieu">
    <span class="lieu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="surligne">
    <span class="surligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="mot_plus_gros">
    <span class="mot_plus_gros">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="mot_plus_petit">
    <span class="mot_plus_petit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="script">
    <span class="script">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="calligraphie">
    <span class="calligraphie">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="traduction">
    <span class="traduction">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="italique">
    <span class="italique">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="blanc">
    <span class="blanc">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="trait">
    <span class="trait">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="caractere_special">
    <span class="caractere_special">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="guillemet_de_suite_de_citation">
    <span class="guillemet_de_suite_de_citation">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="mot_commente">
    <span class="mot_commente">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale">
    <span class="marginale">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale_gauche">
    <span class="marginale_gauche">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="note_bas_page">
    <span class="note_bas_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lateteatoto">
    <span class="lateteatoto">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale">
    <span class="marginale">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lateteatoto">
    <span class="lateteatoto">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bibi">
    <span class="bibi">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="script">
    <span class="script">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="calligraphie">
    <span class="calligraphie">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="script">
    <span class="script">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="calligraphie">
    <span class="calligraphie">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="manuscrit_rouge">
    <span class="manuscrit_rouge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_collage">
    <span class="bloc_collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="tapuscrit">
    <span class="tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit_rouge">
    <span class="bloc_manuscrit_rouge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="personne-personnage">
    <span class="personne-personnage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="oeuvre">
    <span class="oeuvre">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="lieu">
    <span class="lieu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="date">
    <span class="date">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale_droite">
    <span class="marginale_droite">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale_en_haut">
    <span class="marginale_en_haut">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marginale_en_bas">
    <span class="marginale_en_bas">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit_noir">
    <span class="bloc_manuscrit_noir">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="mot_plus_gros">
    <span class="mot_plus_gros">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="fruits_sec">
    <span class="fruits_sec">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="noix">
    <span class="noix">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="amande">
    <span class="amande">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="raisin">
    <span class="raisin">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ananas">
    <span class="ananas">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="page">
    <span class="page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_manuscrit">
    <span class="bloc_manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc_tapuscrit">
    <span class="bloc_tapuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="collage">
    <span class="collage">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="retour_a_la_ligne">
    <span class="retour_a_la_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="incomplet">
    <span class="incomplet">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_original">
    <span class="correction_original">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction_corrige">
    <span class="correction_corrige">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="commentaire">
    <span class="commentaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="manuscrit">
    <span class="manuscrit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="imprimé">
    <span class="imprimé">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="numéro_de_page">
    <span class="numéro_de_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="titre">
    <span class="titre">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="texte_principal">
    <span class="texte_principal">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="note_bas_page">
    <span class="note_bas_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="gauche">
    <span class="gauche">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="centré">
    <span class="centré">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="droit">
    <span class="droit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="stylo_bleu">
    <span class="stylo_bleu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="feutre_bleu">
    <span class="feutre_bleu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="crayon">
    <span class="crayon">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_interligne">
    <span class="ajout_en_interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_ligne">
    <span class="ajout_en_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="alinéa">
    <span class="alinéa">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="appel_de_note">
    <span class="appel_de_note">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="italique">
    <span class="italique">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="gras">
    <span class="gras">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="raturé">
    <span class="raturé">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="souligné">
    <span class="souligné">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="exposant">
    <span class="exposant">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="passage_barré">
    <span class="passage_barré">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge_gauche">
    <span class="ajout_en_marge_gauche">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge_droit">
    <span class="ajout_en_marge_droit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout_en_marge_haut">
    <span class="ajout_en_marge_haut">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="">
    <span class="">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="descriptif">
    <span class="descriptif">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="fichier_image">
    <span class="fichier_image">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="">
    <span class="">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="">
    <span class="">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="foliotation_d_inventaire">
    <span class="foliotation_d_inventaire">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="classement">
    <span class="classement">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="">
    <span class="">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="contenu">
    <span class="contenu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="fin_de_page">
    <span class="fin_de_page">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="bloc">
    <span class="bloc">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="espace">
    <span class="espace">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="paragraphe">
    <span class="paragraphe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="nouvelle_ligne">
    <span class="nouvelle_ligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="rature">
    <span class="rature">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="passage_barre">
    <span class="passage_barre">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="rature_machine">
    <span class="rature_machine">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="correction">
    <span class="correction">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="marque_de_deplacement">
    <span class="marque_de_deplacement">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="presence">
    <span class="presence">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="variante">
    <span class="variante">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="stylo_noir">
    <span class="stylo_noir">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

</xsl:stylesheet>