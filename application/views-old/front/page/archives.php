<div class="col-md-9 col-sm-6 col-xs-12">
	<div class="form-section ">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<?php echo form_open_multipart(base_url().'searchArchiveUp',array('method'=>'post', 'name'=>'searchArchive','id'=>'searchArchive','class'=>'','autocomplete'=>'off'));?>
				<div class="input-group mt-60 mb-20">
					<input type="text" name="pdId" class="form-control" placeholder="PDID/Thematic area"/>
					<span class="input-group-btn">
						<button class="btn btn-default btn-sm" type="submit">Search</button>
					</span>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
		
		<?php 
			if(!empty($this->session->userdata('archiveSess')))
			{
				$search 			= $this->session->userdata('pdId');
				if(is_numeric($search))
				{
					$searchDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $search);
					$theamaticId = $searchDet[0]['thematic_area_id'];
				}
				else
				{
					$searchDet = $this->Front_model->getDataLike('thematic_areas', 'title', $search, 'thematic_area_id');
					$theamaticId = $searchDet[0]['thematic_area_id'];
				}
				
				$themeDet 		= $this->Front_model->getData('thematic_areas', 'thematic_area_id', $theamaticId);
				$caseStudies 	= $this->Front_model->getData('m_archieves', 'thematic_area_id', $themeDet[0]['thematic_area_id']);
		?>
		<small>Total records #<strong><?php echo count($caseStudies);?></strong><br>
		Search results for PDID/Thematic area: <strong>"<?php echo $this->session->userdata('pdId');?>"</strong></small>
		<br><br>
		<div class="row">
			<?php 
				$i=0;
				foreach($caseStudies as $caseStudy)
				{
					++$i;
					if($caseStudy['type']=='Image')
					{ $imgType ='<a href ="'.base_url().'uploads/caseStudy/images/'.$caseStudy['images'].'"><img src="'.base_url().'uploads/caseStudy/images/'.$caseStudy['images'].'" class="img-responsive"></a>';}

					if($caseStudy['type']=='Video')
					{  $imgType ='<iframe width="300" height="200" src="'.$caseStudy['images'].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';}

					if($caseStudy['type']=='Presentation')
					{  $imgType ='<a href ="'.base_url().'uploads/caseStudy/presentation/'.$caseStudy['images'].'"><img src="'.base_url().'assets/front/images/powerpoint.png" class="img-responsive"></a>';}
			?>
			<div class="col-sm-4">
				<div class="img-box">
					<a href="#">
						<?php echo $imgType;?>
						<div class="img-content"><p><?php echo $caseStudy['title'];?></p></div>
					</a>
				</div>
			</div>
			<?php }}?>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<!--<button class="btn btn-warning pull-right btn-sm">More</button>-->
				</div>
			</div>
		</div>
	</div>
</div>