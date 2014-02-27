	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['Terms']['Title']}</span></div>
        <if syntax="$load_terms">
		<div class="blockquote">
            {$load_terms}
		</div>
        <else />
        <div class="error-box">{$this->lang->words['Terms']['Message']}</div>
        </if>
    </div>