var cmThemeShadedVioletBase = '.';

try
{
	if (myThemeShadedVioletBase)
	{
		cmThemeShadedVioletBase = myThemeShadedVioletBase;
	}
}
catch (e)
{
}

var cmThemeShadedViolet =
{
  	    mainFolderLeft: '<div style="width: 11px; height: 21px" class="themeSpacerDiv" />',
        mainFolderRight: '<div style="width: 19px; height: 21px" class="themeSpacerDiv" />',
        mainItemLeft: '<div style="width: 11px; height: 21px" class="themeSpacerDiv" />',
        mainItemRight: '<div style="width: 19px; height: 21px" class="themeSpacerDiv" />',
        folderLeft: '<div style="width: 15px; height: 23px" class="themeSpacerDiv" />',
        folderRight: '<div style="width: 15px; height: 23px" class="themeSpacerDiv" />',
        itemLeft: '<div style="width: 15px; height: 23px" class="themeSpacerDiv" />',
        itemRight: '<div style="width: 15px; height: 23px" class="themeSpacerDiv" />',
        mainSpacing: 0,
        subSpacing: 0,
        delay: 100
};

var cmThemeShadedVioletHSplit = [_cmNoClick, '<td  class="ThemeShadedVioletMenuSplitLeft"><div></div></td>' +
					                          '<td  class="ThemeShadedVioletMenuSplitText"><div></div></td>' +
					                          '<td  class="ThemeShadedVioletMenuSplitRight"><div></div></td>'
		                         ];

var cmThemeShadedVioletMainVSplit = [_cmNoClick, '<div>' +
                            '<table height="23" width="10" ' +
                            ' cellspacing="0"><tr><td class="ThemeShadedVioletHorizontalSplit">' +
                           '<div class="themeSpacerDiv" style=" width: 1px; height: 1px" /></td></tr></table></div>'];

var cmThemeShadedVioletMainHSplit = [_cmNoClick, '<td  class="ThemeShadedVioletMainSplitLeft"><div></div></td>' +
					                          '<td  class="ThemeShadedVioletMainSplitText"><div></div></td>' +
					                          '<td  class="ThemeShadedVioletMainSplitRight"><div></div></td>'
		                           ];    
 
     