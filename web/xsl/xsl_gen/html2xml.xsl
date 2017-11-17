<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <xsl:output method="xml" encoding="UTF-8" indent="no"/>


    <xsl:template match="@*|node()">
        <xsl:copy>            
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>    
    
    <xsl:template match="div[@class='paragraphe']">
        <paragraphe>
            <xsl:apply-templates select="node()"/>
        </paragraphe>
    </xsl:template>

    <xsl:template match="div[@class='ligne']">
        <ligne>
            <xsl:apply-templates select="node()"/>
        </ligne>
    </xsl:template>


<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='descriptif']">
    <descriptif>
        <xsl:apply-templates select="node()"/>
    </descriptif>
</xsl:template>

<xsl:template match="span[@class='fichier_image']">
    <fichier_image>
        <xsl:apply-templates select="node()"/>
    </fichier_image>
</xsl:template>

<xsl:template match="span[@class='cote_volume']">
    <cote_volume>
        <xsl:apply-templates select="node()"/>
    </cote_volume>
</xsl:template>

<xsl:template match="span[@class='proprietes_physiques']">
    <proprietes_physiques>
        <xsl:apply-templates select="node()"/>
    </proprietes_physiques>
</xsl:template>

<xsl:template match="span[@class='transcripteur']">
    <transcripteur>
        <xsl:apply-templates select="node()"/>
    </transcripteur>
</xsl:template>

<xsl:template match="span[@class='domaine']">
    <domaine>
        <xsl:apply-templates select="node()"/>
    </domaine>
</xsl:template>

<xsl:template match="span[@class='corpus']">
    <corpus>
        <xsl:apply-templates select="node()"/>
    </corpus>
</xsl:template>

<xsl:template match="span[@class='document']">
    <document>
        <xsl:apply-templates select="node()"/>
    </document>
</xsl:template>

<xsl:template match="span[@class='nature_document']">
    <nature_document>
        <xsl:apply-templates select="node()"/>
    </nature_document>
</xsl:template>

<xsl:template match="span[@class='date_redaction']">
    <date_redaction>
        <xsl:apply-templates select="node()"/>
    </date_redaction>
</xsl:template>

<xsl:template match="span[@class='date_redaction_page']">
    <date_redaction_page>
        <xsl:apply-templates select="node()"/>
    </date_redaction_page>
</xsl:template>

<xsl:template match="span[@class='lieu_redaction']">
    <lieu_redaction>
        <xsl:apply-templates select="node()"/>
    </lieu_redaction>
</xsl:template>

<xsl:template match="span[@class='lieu_redaction_page']">
    <lieu_redaction_page>
        <xsl:apply-templates select="node()"/>
    </lieu_redaction_page>
</xsl:template>

<xsl:template match="span[@class='commentaire_page']">
    <commentaire_page>
        <xsl:apply-templates select="node()"/>
    </commentaire_page>
</xsl:template>

<xsl:template match="span[@class='contenu']">
    <contenu>
        <xsl:apply-templates select="node()"/>
    </contenu>
</xsl:template>

<xsl:template match="span[@class='tableau']">
    <tableau>
        <xsl:apply-templates select="node()"/>
    </tableau>
</xsl:template>

<xsl:template match="span[@class='reclame']">
    <reclame>
        <xsl:apply-templates select="node()"/>
    </reclame>
</xsl:template>

<xsl:template match="span[@class='contre_reclame']">
    <contre_reclame>
        <xsl:apply-templates select="node()"/>
    </contre_reclame>
</xsl:template>

<xsl:template match="span[@class='ligne_de_tableau']">
    <ligne_de_tableau>
        <xsl:apply-templates select="node()"/>
    </ligne_de_tableau>
</xsl:template>

<xsl:template match="span[@class='cellule_de_tableau']">
    <cellule_de_tableau>
        <xsl:apply-templates select="node()"/>
    </cellule_de_tableau>
</xsl:template>

<xsl:template match="span[@class='figure']">
    <figure>
        <xsl:apply-templates select="node()"/>
    </figure>
</xsl:template>

<xsl:template match="span[@class='pagination']">
    <pagination>
        <xsl:apply-templates select="node()"/>
    </pagination>
</xsl:template>

<xsl:template match="span[@class='foliotation']">
    <foliotation>
        <xsl:apply-templates select="node()"/>
    </foliotation>
</xsl:template>

<xsl:template match="span[@class='bloc_en_interligne']">
    <bloc_en_interligne>
        <xsl:apply-templates select="node()"/>
    </bloc_en_interligne>
</xsl:template>

<xsl:template match="span[@class='texte']">
    <texte>
        <xsl:apply-templates select="node()"/>
    </texte>
</xsl:template>

<xsl:template match="span[@class='multimedia']">
    <multimedia>
        <xsl:apply-templates select="node()"/>
    </multimedia>
</xsl:template>

<xsl:template match="span[@class='trait_de_separation']">
    <trait_de_separation>
        <xsl:apply-templates select="node()"/>
    </trait_de_separation>
</xsl:template>

<xsl:template match="span[@class='liste']">
    <liste>
        <xsl:apply-templates select="node()"/>
    </liste>
</xsl:template>

<xsl:template match="span[@class='liste_2_colonnes']">
    <liste_2_colonnes>
        <xsl:apply-templates select="node()"/>
    </liste_2_colonnes>
</xsl:template>

<xsl:template match="span[@class='ligne_de_liste']">
    <ligne_de_liste>
        <xsl:apply-templates select="node()"/>
    </ligne_de_liste>
</xsl:template>

<xsl:template match="span[@class='titre']">
    <titre>
        <xsl:apply-templates select="node()"/>
    </titre>
</xsl:template>

<xsl:template match="span[@class='sous_titre']">
    <sous_titre>
        <xsl:apply-templates select="node()"/>
    </sous_titre>
</xsl:template>

<xsl:template match="span[@class='titre_courant']">
    <titre_courant>
        <xsl:apply-templates select="node()"/>
    </titre_courant>
</xsl:template>

<xsl:template match="span[@class='paragraphe']">
    <paragraphe>
        <xsl:apply-templates select="node()"/>
    </paragraphe>
</xsl:template>

<xsl:template match="span[@class='bloc_de_citation']">
    <bloc_de_citation>
        <xsl:apply-templates select="node()"/>
    </bloc_de_citation>
</xsl:template>

<xsl:template match="span[@class='ligne']">
    <ligne>
        <xsl:apply-templates select="node()"/>
    </ligne>
</xsl:template>

<xsl:template match="span[@class='vers']">
    <vers>
        <xsl:apply-templates select="node()"/>
    </vers>
</xsl:template>

<xsl:template match="span[@class='raturé']">
    <raturé>
        <xsl:apply-templates select="node()"/>
    </raturé>
</xsl:template>

<xsl:template match="span[@class='gras']">
    <gras>
        <xsl:apply-templates select="node()"/>
    </gras>
</xsl:template>

<xsl:template match="span[@class='souligné']">
    <souligné>
        <xsl:apply-templates select="node()"/>
    </souligné>
</xsl:template>

<xsl:template match="span[@class='souligne_au_dessus']">
    <souligne_au_dessus>
        <xsl:apply-templates select="node()"/>
    </souligne_au_dessus>
</xsl:template>

<xsl:template match="span[@class='exposant']">
    <exposant>
        <xsl:apply-templates select="node()"/>
    </exposant>
</xsl:template>

<xsl:template match="span[@class='indice']">
    <indice>
        <xsl:apply-templates select="node()"/>
    </indice>
</xsl:template>

<xsl:template match="span[@class='averifier']">
    <averifier>
        <xsl:apply-templates select="node()"/>
    </averifier>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='surcharge']">
    <surcharge>
        <xsl:apply-templates select="node()"/>
    </surcharge>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='interligne']">
    <interligne>
        <xsl:apply-templates select="node()"/>
    </interligne>
</xsl:template>

<xsl:template match="span[@class='variante_en_interligne']">
    <variante_en_interligne>
        <xsl:apply-templates select="node()"/>
    </variante_en_interligne>
</xsl:template>

<xsl:template match="span[@class='date']">
    <date>
        <xsl:apply-templates select="node()"/>
    </date>
</xsl:template>

<xsl:template match="span[@class='lieu']">
    <lieu>
        <xsl:apply-templates select="node()"/>
    </lieu>
</xsl:template>

<xsl:template match="span[@class='surligne']">
    <surligne>
        <xsl:apply-templates select="node()"/>
    </surligne>
</xsl:template>

<xsl:template match="span[@class='mot_plus_gros']">
    <mot_plus_gros>
        <xsl:apply-templates select="node()"/>
    </mot_plus_gros>
</xsl:template>

<xsl:template match="span[@class='mot_plus_petit']">
    <mot_plus_petit>
        <xsl:apply-templates select="node()"/>
    </mot_plus_petit>
</xsl:template>

<xsl:template match="span[@class='script']">
    <script>
        <xsl:apply-templates select="node()"/>
    </script>
</xsl:template>

<xsl:template match="span[@class='calligraphie']">
    <calligraphie>
        <xsl:apply-templates select="node()"/>
    </calligraphie>
</xsl:template>

<xsl:template match="span[@class='traduction']">
    <traduction>
        <xsl:apply-templates select="node()"/>
    </traduction>
</xsl:template>

<xsl:template match="span[@class='italique']">
    <italique>
        <xsl:apply-templates select="node()"/>
    </italique>
</xsl:template>

<xsl:template match="span[@class='blanc']">
    <blanc>
        <xsl:apply-templates select="node()"/>
    </blanc>
</xsl:template>

<xsl:template match="span[@class='trait']">
    <trait>
        <xsl:apply-templates select="node()"/>
    </trait>
</xsl:template>

<xsl:template match="span[@class='caractere_special']">
    <caractere_special>
        <xsl:apply-templates select="node()"/>
    </caractere_special>
</xsl:template>

<xsl:template match="span[@class='guillemet_de_suite_de_citation']">
    <guillemet_de_suite_de_citation>
        <xsl:apply-templates select="node()"/>
    </guillemet_de_suite_de_citation>
</xsl:template>

<xsl:template match="span[@class='mot_commente']">
    <mot_commente>
        <xsl:apply-templates select="node()"/>
    </mot_commente>
</xsl:template>

<xsl:template match="span[@class='marginale']">
    <marginale>
        <xsl:apply-templates select="node()"/>
    </marginale>
</xsl:template>

<xsl:template match="span[@class='marginale_gauche']">
    <marginale_gauche>
        <xsl:apply-templates select="node()"/>
    </marginale_gauche>
</xsl:template>

<xsl:template match="span[@class='note_bas_page']">
    <note_bas_page>
        <xsl:apply-templates select="node()"/>
    </note_bas_page>
</xsl:template>

<xsl:template match="span[@class='lateteatoto']">
    <lateteatoto>
        <xsl:apply-templates select="node()"/>
    </lateteatoto>
</xsl:template>

<xsl:template match="span[@class='marginale']">
    <marginale>
        <xsl:apply-templates select="node()"/>
    </marginale>
</xsl:template>

<xsl:template match="span[@class='lateteatoto']">
    <lateteatoto>
        <xsl:apply-templates select="node()"/>
    </lateteatoto>
</xsl:template>

<xsl:template match="span[@class='bibi']">
    <bibi>
        <xsl:apply-templates select="node()"/>
    </bibi>
</xsl:template>

<xsl:template match="span[@class='script']">
    <script>
        <xsl:apply-templates select="node()"/>
    </script>
</xsl:template>

<xsl:template match="span[@class='calligraphie']">
    <calligraphie>
        <xsl:apply-templates select="node()"/>
    </calligraphie>
</xsl:template>

<xsl:template match="span[@class='script']">
    <script>
        <xsl:apply-templates select="node()"/>
    </script>
</xsl:template>

<xsl:template match="span[@class='calligraphie']">
    <calligraphie>
        <xsl:apply-templates select="node()"/>
    </calligraphie>
</xsl:template>

<xsl:template match="span[@class='manuscrit_rouge']">
    <manuscrit_rouge>
        <xsl:apply-templates select="node()"/>
    </manuscrit_rouge>
</xsl:template>

<xsl:template match="span[@class='bloc_collage']">
    <bloc_collage>
        <xsl:apply-templates select="node()"/>
    </bloc_collage>
</xsl:template>

<xsl:template match="span[@class='tapuscrit']">
    <tapuscrit>
        <xsl:apply-templates select="node()"/>
    </tapuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit_rouge']">
    <bloc_manuscrit_rouge>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit_rouge>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='personne-personnage']">
    <personne-personnage>
        <xsl:apply-templates select="node()"/>
    </personne-personnage>
</xsl:template>

<xsl:template match="span[@class='oeuvre']">
    <oeuvre>
        <xsl:apply-templates select="node()"/>
    </oeuvre>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='lieu']">
    <lieu>
        <xsl:apply-templates select="node()"/>
    </lieu>
</xsl:template>

<xsl:template match="span[@class='date']">
    <date>
        <xsl:apply-templates select="node()"/>
    </date>
</xsl:template>

<xsl:template match="span[@class='marginale_droite']">
    <marginale_droite>
        <xsl:apply-templates select="node()"/>
    </marginale_droite>
</xsl:template>

<xsl:template match="span[@class='marginale_en_haut']">
    <marginale_en_haut>
        <xsl:apply-templates select="node()"/>
    </marginale_en_haut>
</xsl:template>

<xsl:template match="span[@class='marginale_en_bas']">
    <marginale_en_bas>
        <xsl:apply-templates select="node()"/>
    </marginale_en_bas>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit_noir']">
    <bloc_manuscrit_noir>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit_noir>
</xsl:template>

<xsl:template match="span[@class='mot_plus_gros']">
    <mot_plus_gros>
        <xsl:apply-templates select="node()"/>
    </mot_plus_gros>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='fruits_sec']">
    <fruits_sec>
        <xsl:apply-templates select="node()"/>
    </fruits_sec>
</xsl:template>

<xsl:template match="span[@class='noix']">
    <noix>
        <xsl:apply-templates select="node()"/>
    </noix>
</xsl:template>

<xsl:template match="span[@class='amande']">
    <amande>
        <xsl:apply-templates select="node()"/>
    </amande>
</xsl:template>

<xsl:template match="span[@class='raisin']">
    <raisin>
        <xsl:apply-templates select="node()"/>
    </raisin>
</xsl:template>

<xsl:template match="span[@class='ananas']">
    <ananas>
        <xsl:apply-templates select="node()"/>
    </ananas>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='page']">
    <page>
        <xsl:apply-templates select="node()"/>
    </page>
</xsl:template>

<xsl:template match="span[@class='bloc_manuscrit']">
    <bloc_manuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_manuscrit>
</xsl:template>

<xsl:template match="span[@class='bloc_tapuscrit']">
    <bloc_tapuscrit>
        <xsl:apply-templates select="node()"/>
    </bloc_tapuscrit>
</xsl:template>

<xsl:template match="span[@class='collage']">
    <collage>
        <xsl:apply-templates select="node()"/>
    </collage>
</xsl:template>

<xsl:template match="span[@class='retour_a_la_ligne']">
    <retour_a_la_ligne>
        <xsl:apply-templates select="node()"/>
    </retour_a_la_ligne>
</xsl:template>

<xsl:template match="span[@class='incomplet']">
    <incomplet>
        <xsl:apply-templates select="node()"/>
    </incomplet>
</xsl:template>

<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='correction_original']">
    <correction_original>
        <xsl:apply-templates select="node()"/>
    </correction_original>
</xsl:template>

<xsl:template match="span[@class='correction_corrige']">
    <correction_corrige>
        <xsl:apply-templates select="node()"/>
    </correction_corrige>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='commentaire']">
    <commentaire>
        <xsl:apply-templates select="node()"/>
    </commentaire>
</xsl:template>

<xsl:template match="span[@class='manuscrit']">
    <manuscrit>
        <xsl:apply-templates select="node()"/>
    </manuscrit>
</xsl:template>

<xsl:template match="span[@class='imprimé']">
    <imprimé>
        <xsl:apply-templates select="node()"/>
    </imprimé>
</xsl:template>

<xsl:template match="span[@class='numéro_de_page']">
    <numéro_de_page>
        <xsl:apply-templates select="node()"/>
    </numéro_de_page>
</xsl:template>

<xsl:template match="span[@class='titre']">
    <titre>
        <xsl:apply-templates select="node()"/>
    </titre>
</xsl:template>

<xsl:template match="span[@class='texte_principal']">
    <texte_principal>
        <xsl:apply-templates select="node()"/>
    </texte_principal>
</xsl:template>

<xsl:template match="span[@class='note_bas_page']">
    <note_bas_page>
        <xsl:apply-templates select="node()"/>
    </note_bas_page>
</xsl:template>

<xsl:template match="span[@class='gauche']">
    <gauche>
        <xsl:apply-templates select="node()"/>
    </gauche>
</xsl:template>

<xsl:template match="span[@class='centré']">
    <centré>
        <xsl:apply-templates select="node()"/>
    </centré>
</xsl:template>

<xsl:template match="span[@class='droit']">
    <droit>
        <xsl:apply-templates select="node()"/>
    </droit>
</xsl:template>

<xsl:template match="span[@class='stylo_bleu']">
    <stylo_bleu>
        <xsl:apply-templates select="node()"/>
    </stylo_bleu>
</xsl:template>

<xsl:template match="span[@class='feutre_bleu']">
    <feutre_bleu>
        <xsl:apply-templates select="node()"/>
    </feutre_bleu>
</xsl:template>

<xsl:template match="span[@class='crayon']">
    <crayon>
        <xsl:apply-templates select="node()"/>
    </crayon>
</xsl:template>

<xsl:template match="span[@class='ajout_en_interligne']">
    <ajout_en_interligne>
        <xsl:apply-templates select="node()"/>
    </ajout_en_interligne>
</xsl:template>

<xsl:template match="span[@class='ajout_en_ligne']">
    <ajout_en_ligne>
        <xsl:apply-templates select="node()"/>
    </ajout_en_ligne>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge']">
    <ajout_en_marge>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge>
</xsl:template>

<xsl:template match="span[@class='alinéa']">
    <alinéa>
        <xsl:apply-templates select="node()"/>
    </alinéa>
</xsl:template>

<xsl:template match="span[@class='appel_de_note']">
    <appel_de_note>
        <xsl:apply-templates select="node()"/>
    </appel_de_note>
</xsl:template>

<xsl:template match="span[@class='italique']">
    <italique>
        <xsl:apply-templates select="node()"/>
    </italique>
</xsl:template>

<xsl:template match="span[@class='gras']">
    <gras>
        <xsl:apply-templates select="node()"/>
    </gras>
</xsl:template>

<xsl:template match="span[@class='raturé']">
    <raturé>
        <xsl:apply-templates select="node()"/>
    </raturé>
</xsl:template>

<xsl:template match="span[@class='souligné']">
    <souligné>
        <xsl:apply-templates select="node()"/>
    </souligné>
</xsl:template>

<xsl:template match="span[@class='exposant']">
    <exposant>
        <xsl:apply-templates select="node()"/>
    </exposant>
</xsl:template>

<xsl:template match="span[@class='douteux']">
    <douteux>
        <xsl:apply-templates select="node()"/>
    </douteux>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='passage_barré']">
    <passage_barré>
        <xsl:apply-templates select="node()"/>
    </passage_barré>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge_gauche']">
    <ajout_en_marge_gauche>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge_gauche>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge_droit']">
    <ajout_en_marge_droit>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge_droit>
</xsl:template>

<xsl:template match="span[@class='ajout_en_marge_haut']">
    <ajout_en_marge_haut>
        <xsl:apply-templates select="node()"/>
    </ajout_en_marge_haut>
</xsl:template>

<xsl:template match="span[@class='']">
    <>
        <xsl:apply-templates select="node()"/>
    </>
</xsl:template>

<xsl:template match="span[@class='descriptif']">
    <descriptif>
        <xsl:apply-templates select="node()"/>
    </descriptif>
</xsl:template>

<xsl:template match="span[@class='fichier_image']">
    <fichier_image>
        <xsl:apply-templates select="node()"/>
    </fichier_image>
</xsl:template>

<xsl:template match="span[@class='']">
    <>
        <xsl:apply-templates select="node()"/>
    </>
</xsl:template>

<xsl:template match="span[@class='']">
    <>
        <xsl:apply-templates select="node()"/>
    </>
</xsl:template>

<xsl:template match="span[@class='foliotation_d_inventaire']">
    <foliotation_d_inventaire>
        <xsl:apply-templates select="node()"/>
    </foliotation_d_inventaire>
</xsl:template>

<xsl:template match="span[@class='classement']">
    <classement>
        <xsl:apply-templates select="node()"/>
    </classement>
</xsl:template>

<xsl:template match="span[@class='']">
    <>
        <xsl:apply-templates select="node()"/>
    </>
</xsl:template>

<xsl:template match="span[@class='contenu']">
    <contenu>
        <xsl:apply-templates select="node()"/>
    </contenu>
</xsl:template>

<xsl:template match="span[@class='fin_de_page']">
    <fin_de_page>
        <xsl:apply-templates select="node()"/>
    </fin_de_page>
</xsl:template>

<xsl:template match="span[@class='bloc']">
    <bloc>
        <xsl:apply-templates select="node()"/>
    </bloc>
</xsl:template>

<xsl:template match="span[@class='espace']">
    <espace>
        <xsl:apply-templates select="node()"/>
    </espace>
</xsl:template>

<xsl:template match="span[@class='paragraphe']">
    <paragraphe>
        <xsl:apply-templates select="node()"/>
    </paragraphe>
</xsl:template>

<xsl:template match="span[@class='nouvelle_ligne']">
    <nouvelle_ligne>
        <xsl:apply-templates select="node()"/>
    </nouvelle_ligne>
</xsl:template>

<xsl:template match="span[@class='rature']">
    <rature>
        <xsl:apply-templates select="node()"/>
    </rature>
</xsl:template>

<xsl:template match="span[@class='passage_barre']">
    <passage_barre>
        <xsl:apply-templates select="node()"/>
    </passage_barre>
</xsl:template>

<xsl:template match="span[@class='rature_machine']">
    <rature_machine>
        <xsl:apply-templates select="node()"/>
    </rature_machine>
</xsl:template>

<xsl:template match="span[@class='correction']">
    <correction>
        <xsl:apply-templates select="node()"/>
    </correction>
</xsl:template>

<xsl:template match="span[@class='marque_de_deplacement']">
    <marque_de_deplacement>
        <xsl:apply-templates select="node()"/>
    </marque_de_deplacement>
</xsl:template>

<xsl:template match="span[@class='ajout']">
    <ajout>
        <xsl:apply-templates select="node()"/>
    </ajout>
</xsl:template>

<xsl:template match="span[@class='illisible']">
    <illisible>
        <xsl:apply-templates select="node()"/>
    </illisible>
</xsl:template>

<xsl:template match="span[@class='presence']">
    <presence>
        <xsl:apply-templates select="node()"/>
    </presence>
</xsl:template>

<xsl:template match="span[@class='variante']">
    <variante>
        <xsl:apply-templates select="node()"/>
    </variante>
</xsl:template>

<xsl:template match="span[@class='stylo_noir']">
    <stylo_noir>
        <xsl:apply-templates select="node()"/>
    </stylo_noir>
</xsl:template>

</xsl:stylesheet>