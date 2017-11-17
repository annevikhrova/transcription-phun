<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>



<xsl:template match="@*|node()">
                    <xsl:copy>   
                        <xsl:apply-templates select="@*|node()"/>
                    </xsl:copy>
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
<xsl:template match="interligne">
    <span class="interligne">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>
<xsl:template match="pantoufle">
    <span class="pantoufle">
        <xsl:apply-templates select="node()"/>
    </span>
</xsl:template>
