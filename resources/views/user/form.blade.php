<!-- Form Edit Profile -->
<form action="{{url('/user/'.Auth::user()->id.'/edit')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
	{{ csrf_field() }}
	<div class="form-group">    
        <div class="edit-profile">
            <div class="card text-center">
                <div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
                    {{$user->name}}
                </div>
                <div class="card-block row">
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">Email</span>
                        </div>
                        <div class="profile-content">
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">Role</span>
                        </div>
                        <div class="profile-content">
                            {{$user->role}}
                        </div>
                    </div>
                </div>
                <div class="card-block row">
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">Line</span>
                        </div>
                        <div class="profile-content">
                            <input type="text" class="edit-profile-content" name="line" value='{{isset($user->line)? $user->line:""}}' placeholder="Line ID" >
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">Phone</span>
                        </div>
                        <div class="profile-content">
                            <input type="text" class="edit-profile-content" name="phone" value='{{isset($user->phone)? $user->phone:""}}' placeholder="Phone Number">
                        </div>
                    </div>
                </div>
                <div class="card-block row">
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">LinkedIn</span>
                        </div>
                        <div class="profile-content">
                            <input type="text" class="edit-profile-content" name="linkedin" value='{{isset($user->linkedin)? $user->linkedin:""}}' placeholder="LinkedIn">    
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 profile-info">
                        <div class="profile-title">
                            <span class="card-title montserrat">Git</span>
                        </div>
                        <div class="profile-content">
                            <input type="text" class="edit-profile-content" name="git" value='{{isset($user->git)? $user->git:""}}' placeholder="Git">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-12 profile-info">
                <div class="profile-title">
                    <br><span class="card-title montserrat">Resume / Portofolio</span>
                </div>
                <div class="profile-content" id="drop-area">
                    <center><input type="file" class="edit-profile-content" name="resume" value='{{isset($user->git)? $user->git:""}}' placeholder="Resume / Portofolio" accept="application/pdf"></center>
                </div>
            </div>
            <center><button type="submit" class="btn btn-primary dark-grey motask-button">
                    <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Edit
                </button>
            </center>
        </div>
	</div>
</form>