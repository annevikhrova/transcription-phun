<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>



<xsl:template match="@*|node()">
                    <xsl:copy>   
                        <xsl:apply-templates select="@*|node()"/>
                    </xsl:copy>
                </xsl:template> 


    <xsl:template match="paragraphe">
        <div class="paragraphe">
            <xsl:apply-templates select="node()"/>
        </div>
    </xsl:template>

    <xsl:template match="ligne">
        <div class="ligne">
            <xsl:apply-templates select="node()"/>
        </div>
    </xsl:template> 


<xsl:template match="ligne/guillemet_de_suite_de_citation">
    <span class="guillemet_de_suite_de_citation">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/biffe">
    <span class="biffe">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/code">
    <span class="code">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/exposant">
    <span class="exposant">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/indice">
    <span class="indice">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/ajout">
    <span class="ajout">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/interligne">
    <span class="interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/date">
    <span class="date">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/lieu">
    <span class="lieu">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/gras">
    <span class="gras">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/souligne">
    <span class="souligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/souligne_au_dessus">
    <span class="souligne_au_dessus">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/illisible">
    <span class="illisible">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/douteux">
    <span class="douteux">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/surcharge">
    <span class="surcharge">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/averifier">
    <span class="averifier">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/surligne">
    <span class="surligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/mot_plus_gros">
    <span class="mot_plus_gros">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/mot_plus_petit">
    <span class="mot_plus_petit">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/script">
    <span class="script">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/calligraphie">
    <span class="calligraphie">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/traduction">
    <span class="traduction">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/italique">
    <span class="italique">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/blanc">
    <span class="blanc">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/trait">
    <span class="trait">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/caractere_special">
    <span class="caractere_special">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/variante_en_interligne">
    <span class="variante_en_interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/mot_commente">
    <span class="mot_commente">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/reclame">
    <span class="reclame">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


<xsl:template match="ligne/contre_reclame">
    <span class="contre_reclame">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>


</xsl:stylesheet>