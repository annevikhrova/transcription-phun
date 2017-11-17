<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <xsl:output method="xml" encoding="UTF-8" indent="no"/>
    
    <!--
 <xsl:output indent="yes"/>
 -->   
    <!-- copie identité -->
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
 


<xsl:template match="span[@class='guillemet_de_suite_de_citation']">
    <guillemet_de_suite_de_citation>
        <xsl:apply-templates select="node()"/>
    </guillemet_de_suite_de_citation>
</xsl:template>


<xsl:template match="span[@class='biffe']">
    <biffe>
        <xsl:apply-templates select="node()"/>
    </biffe>
</xsl:template>


<xsl:template match="span[@class='code']">
    <code>
        <xsl:apply-templates select="node()"/>
    </code>
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


<xsl:template match="span[@class='gras']">
    <gras>
        <xsl:apply-templates select="node()"/>
    </gras>
</xsl:template>


<xsl:template match="span[@class='souligne']">
    <souligne>
        <xsl:apply-templates select="node()"/>
    </souligne>
</xsl:template>


<xsl:template match="span[@class='souligne_au_dessus']">
    <souligne_au_dessus>
        <xsl:apply-templates select="node()"/>
    </souligne_au_dessus>
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


<xsl:template match="span[@class='surcharge']">
    <surcharge>
        <xsl:apply-templates select="node()"/>
    </surcharge>
</xsl:template>


<xsl:template match="span[@class='averifier']">
    <averifier>
        <xsl:apply-templates select="node()"/>
    </averifier>
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


<xsl:template match="span[@class='variante_en_interligne']">
    <variante_en_interligne>
        <xsl:apply-templates select="node()"/>
    </variante_en_interligne>
</xsl:template>


<xsl:template match="span[@class='mot_commente']">
    <mot_commente>
        <xsl:apply-templates select="node()"/>
    </mot_commente>
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


</xsl:stylesheet>