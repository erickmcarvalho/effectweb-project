	<script type="text/javascript">
	$(function()
	{
		$("#DownloadLinks select").change(function()
		{
			value = $(this).val();
			
			if(value != "None")
			{
				linkOriginal = decodeURIComponent(value);
				window.open(linkOriginal, "Download:"+Math.random());
				$(this).val("None");
			}
		});
	});
	</script>
	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['Downloads']['Title']}</span></div>
        <form name="DownloadLinks" id="DownloadLinks">
        <foreach loop="$this->settings['DOWNLOADS']['CATEGORYS'] as $key => $category">
        <h4>{$category}</h4>
        <table width="100%" class="tableBackColumn">
        	<tr>
            	<td width="118"><strong>{$this->lang->words['Downloads']['Table']['Archive']}</strong></td>
                <td width="194"><strong>{$this->lang->words['Downloads']['Table']['Description']}</strong></td>
                <td width="83"><strong>{$this->lang->words['Downloads']['Table']['Size']}</strong></td>
                <td width="71"><strong>{$this->lang->words['Downloads']['Table']['Link']}</strong></td>
            </tr>
            <foreach loop="$this->settings['DOWNLOADS']['ARCHIVES'][$key] as $file_key => $FILE">
            <tr>
            	<td>{$FILE['NAME']}</td>
                <td>{$FILE['DESC']}</td>
                <td>{$FILE['SIZE']}</td>
                <td>
                	<select name="DownLinks_{$key}_{$file_key}" id="DownLinks_{$key}_{$file_key}" class="selectField">
                    	<option value="None" selected="selected">{$this->lang->words['Words']['Select']}</option>
                        <foreach loop="$this->settings['DOWNLOADS']['ARCHIVES'][$key][$file_key]['LINK'] as $i => $l">
                        <php>$l = urlencode($l);</php>
                        <option value="{$l}">{$this->lang->words['Downloads']['Table']['Option']} #{$i}</option>
                        </foreach>
            		</select>
            	</td>
            </tr>
            </foreach>
		</table><br />
        </foreach>
        </form>
        <h4>{$this->lang->words['Downloads']['Requirements']['Title']}</h4>
        <table width="100%" class="tableBackColumn">
        	<tr>
            	<td width="118"><strong>{$this->lang->words['Downloads']['Requirements']['Device']}</strong></td>
                <td width="194"><strong>{$this->lang->words['Downloads']['Requirements']['Minimum']}</strong></td>
                <td width="83"><strong>{$this->lang->words['Downloads']['Requirements']['Recommended']}</strong></td>
            </tr>
            <tr>
            	<td width="118">{$this->lang->words['Downloads']['Requirements']['Processor'][0]}</td>
                <td width="118">{$this->lang->words['Downloads']['Requirements']['Processor'][1]}</td>
                <td width="118">{$this->lang->words['Downloads']['Requirements']['Processor'][2]}</td>
            </tr>
            <tr>
            	<td width="194">{$this->lang->words['Downloads']['Requirements']['Memory'][0]}</td>
                <td width="194">{$this->lang->words['Downloads']['Requirements']['Memory'][1]}</td>
                <td width="194">{$this->lang->words['Downloads']['Requirements']['Memory'][2]}</td>
            </tr>
            <tr>
            	<td width="194">{$this->lang->words['Downloads']['Requirements']['OperationSystem'][0]}</td>
                <td width="194">{$this->lang->words['Downloads']['Requirements']['OperationSystem'][1]}</td>
                <td width="194">{$this->lang->words['Downloads']['Requirements']['OperationSystem'][2]}</td>
            </tr>
            <tr>
            	<td width="83">{$this->lang->words['Downloads']['Requirements']['Graphics'][0]}</td>
                <td width="83">{$this->lang->words['Downloads']['Requirements']['Graphics'][1]}</td>
                <td width="83">{$this->lang->words['Downloads']['Requirements']['Graphics'][2]}</td>
        	</tr>
        </table><br />
        <h4>{$this->lang->words['Downloads']['Drivers']}</h4>
        <div align="center" class="setQuote">
        	<ul id="drivers">
            	<li id="ati"><a target="_black" href="http://support.amd.com/us/gpudownload/Pages/index.aspx"></a></li>
                <li id="intel"><a target="_black" href="http://downloadcenter.intel.com/"></a></li>
                <li id="matrox"><a target="_black" href="http://www.matrox.com/mga/support/drivers/"></a></li>
                <li id="nvidia"><a target="_black" href="http://www.nvidia.com/Download/index.aspx"></a></li>
			</ul>
    	</div>
    </div>