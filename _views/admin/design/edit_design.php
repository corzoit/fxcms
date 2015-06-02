<div class="row">
    <div class="col-lg-12 text-center">
        <h1>Design</h1>
    </div>    
</div>
<div class="row">
    <div class="col-lg-2 text-center">
    </div>
    <div class="col-lg-3 text-center">
        <div class="panel panel-default">        
            <div class="panel-body a-icon" data-type='a-container-h'>                
                CONTAINER HORIZONTAL                
            </div>
        </div>
    </div>
    <div class="col-lg-3 text-center">
        <div class="panel panel-default">        
            <div class="panel-body a-icon" data-type='a-container-v'>                
                CONTAINER VERTICAL                
            </div>
        </div>
    </div>
    <div class="col-lg-3 text-center">
        <div class="panel panel-default">        
            <div class="panel-body a-icon" data-type='a-widget'>                
                WIDGET               
            </div>
        </div>
    </div>
    <div class="col-lg-2 text-center">
    </div>
</div>

<div class="row">
    <div class="a-main-container" >
        <?php 
        if(count($data_design))
        {
            echo($data_design['html_content']);
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <div class="formDesign">
            <p></p>
            <input id="design_id" type="hidden" name="design_id" value="<?=$data_design['fx_design_id']?>" >
            <input id="design_name" type="hidden" name="design_id" value="<?=$data_design['name']?>" >
            <input id="actionFormDesign" type="hidden" name="action" value="updateDesign">
            <button class="btn btn-primary">Save</button>
            <a href="" onclick="window.close();" class="btn btn-warning">Close</a>
        </div>        
    </div>
</div>



