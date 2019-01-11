<!-- Form Post Project -->
<form action="{{ $action=='create'? url('project/create'):url('project/edit') }}" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
		<input type="hidden" name="id" value="{{isset($project->id)? $project->id:''}}">
		<div class="row row-from">
			<div class="col-md-6">
				<input type="string" class="form-control motask-input" name="project_owner" value='{{isset($project->project_owner)? $project->project_owner:""}}' placeholder="Client Name*">
			</div>
			<div class="col-md-6">
				<select class="form-control motask-input" name="category" required>
					<option selected disabled value="">Category*</option>
					<option value="Website" {{isset($project->category) && $project->category=='Website'? 'selected':''}}>Website</option>
					<option value="Mobile" {{isset($project->category) && $project->category=='Mobile'? 'selected':''}}>Mobile</option>
					<option value="Desktop" {{isset($project->category) && $project->category=='Desktop'? 'selected':''}}>Desktop</option>
					<option value="Other" {{isset($project->category) && $project->category=='Others'? 'selected':''}}>Others</option>
				</select>
			</div>
		</div>
		<div class="row row-form">
			<div class="col-md-12">
				<input type="text" class="form-control motask-input" name="title" value='{{isset($project->title)? $project->title:""}}' required placeholder="Project Title*">
			</div>
		</div>
		<div class="row row-form">
			<div class="col-md-12">
				<div class="input-group motask-input">
					<span class="input-group-addon" id="budget-input">Rp.</span>
					<input type="number" class="form-control motask-input" name="budget" aria-describedby="budget-input" value='{{isset($project->budget)? $project->budget:""}}' placeholder="Budget (Optional)">
				</div>
			</div>
		</div>
		<div class="row row-form">
			<div class="col-md-6">
				<input type="text" class="form-control motask-input" name="deadline" value='{{isset($project->deadline)? $project->deadline:""}}' required placeholder="Deadline" onmouseenter="(this.type='date')">
			</div>
			<div class="col-md-6">
				<input type="number" class="form-control motask-input" name="number_of_programmers" min="1" max="10" value='{{isset($project->total_programmer)? $project->total_programmer:""}}' required placeholder="Programmers*">
			</div>
		</div>
		<div class="row row-form">
			<div class="col-md-12">
				<textarea onkeyup="AutoGrowTextArea(this)" style="overflow:hidden" class="form-control motask-input" name="specification_desc"  required placeholder="Specification*">{{isset($project->specification_desc)? $project->specification_desc:""}}</textarea>
			</div>
		</div>
		<div class="row row-form">
			<div class="col-md-12">
				<textarea onkeyup="AutoGrowTextArea(this)" style="overflow:hidden" class="form-control motask-input" name="notes" placeholder="Notes (will only be visible to project managers and marketings)">{{isset($project->notes)? $project->notes:""}}</textarea>
			</div>
		</div>
		<center><button type="submit" class="btn btn-primary transparent motask-button btn-lg">
			<i class="fa fa-paper-plane" aria-hidden="true"></i> {{$action=='create'? 'Post Project':'Update Project'}}
		</button></center>
	</div>
</form>