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

<xsl:template match="biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="gras">
    <span class="gras">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="souligne">
    <span class="souligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="souligne_au_dessus">
    <span class="souligne_au_dessus">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

<xsl:template match="code">
    <span class="code">
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

<xsl:template match="ajout_en_marge">
    <span class="ajout_en_marge">
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

<xsl:template match="Bibi">
    <span class="Bibi">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>

</xsl:stylesheet>