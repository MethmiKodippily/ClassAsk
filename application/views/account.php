<div class="content-container">
	<div class="detail-section">
		<div class="title">
            <span class="text">Account Details</span>
        </div>

        <div class="boxes">
			<div class="profile-card">
                <div class="profile-card-header"></div>
                <div class="profile-card-body">
				
                    <div class="joined-date">
                        <small></small>
                    </div>

                    <form>
                        <div class="profile-form-row">
                            <div class="profile-form-group">
                                <label class="profile-form-label" for="firstName">First name</label>
                                <input class="profile-form-control" id="firstName" type="text" value="" readonly="true">
                                <small><?php echo form_error('first_name'); ?></small>
                            </div>
                            <div class="profile-form-group">
                                <label class="profile-form-label" for="lastName">Last name</label>
                                <input class="profile-form-control" id="lastName" type="text" value="" readonly="true">
                            </div>
                        </div>

                        <div class="profile-form-row">
                            <div class="profile-form-group">
                                <label class="profile-form-label" for="email">Email address</label>
                                <input class="profile-form-control" id="email" type="email" value="" readonly="true">
                            </div>
                        </div>

                        <button class="profile-btn save" type="button">Save</button>
                        <button class="profile-btn edit" type="button">Edit Profile</button>
                        <button class="profile-btn cancel" type="button">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<div class="password-section">
        <div class="boxes">
			<div class="profile-card">
                <div class="profile-card-header">Change Password</div>
                <div class="profile-card-body">

                <form>
                    <div class="profile-form-row">
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="oldPassword">Old password</label>
                            <div class="input-wrapper">
								<input class="profile-form-control" id="oldPassword" type="password">
								<i class='bx bx-hide eye-icon' onclick="togglePasswordVisibility('oldPassword')"></i>
							</div>
                        </div>
                    </div>

                    <div class="profile-form-row">
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="newPassword">New password</label>
                            <div class="input-wrapper">
								<input class="profile-form-control" id="newPassword" type="password">
								<i class='bx bx-hide eye-icon' onclick="togglePasswordVisibility('newPassword')"></i>
							</div>
                        </div>
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="confirmPassword">Confirm password</label>
                            <div class="input-wrapper">
								<input class="profile-form-control" id="confirmPassword" type="password">
								<i class='bx bx-hide eye-icon' onclick="togglePasswordVisibility('confirmPassword')"></i>
							</div>
                        </div>
                    </div>

                    <button class="profile-btn changePassword" type="button">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<script>
	var baseUrl = $('#base').val();

	var UserDetailModel = Backbone.Model.extend({
		urlRoot: baseUrl + 'api/user/details',
		defaults: {
			first_name: "",
			last_name: "",
			user_email: "",
			created_at: "",
    		user_type: ""
		}
	});

    var UserUpdateModel = Backbone.Model.extend({
        urlRoot: baseUrl + 'api/user/update',
        defaults: {
            first_name: "",
            last_name: "",
            user_email: ""
        }
    });

	var UserDetailView = Backbone.View.extend({
		el: '.detail-section',
		
		initialize: function() {
			this.model = new UserDetailModel();
			
			this.model.fetch({
				success: this.render.bind(this),
				error: function(model, response) {
					console.error('Error fetching user details:', response.statusText);
				}
			});
		},

		render: function() {
			this.$('.profile-card-header').text(this.model.get('user_type'));
			this.$('.joined-date small').text('Joined on ' + this.model.get('created_at'));

			this.$('#firstName').val(this.model.get('first_name'));
			this.$('#lastName').val(this.model.get('last_name'));
			this.$('#email').val(this.model.get('user_email'));

			return this;
		},

		events: {
			'click .edit': 'toggleEditMode',
			'click .cancel': 'closeEditMode',
			'click .save': 'saveChanges'
		},

		toggleEditMode: function() {
			this.$('.profile-form-control').prop('readonly', function(_, readonly) {
				return !readonly;
			});

			this.$('.edit').hide();
			this.$('.save').show();
			this.$('.cancel').show();
		},

		closeEditMode: function() {
			this.$('.profile-form-control').prop('readonly', true);

			this.$('#firstName').val(this.model.get('first_name'));
			this.$('#lastName').val(this.model.get('last_name'));
			this.$('#email').val(this.model.get('user_email'))

			this.$('.save').hide();
			this.$('.cancel').hide();
			this.$('.edit').show();
		},

		saveChanges: function() {
            var firstName = this.$('#firstName').val();
            var lastName = this.$('#lastName').val();
            var email = this.$('#email').val();

            if (firstName !== this.model.get('first_name') ||
                lastName !== this.model.get('last_name') ||
                email !== this.model.get('user_email')) {

                var updateUser = new UserUpdateModel({
                    first_name: firstName,
                    last_name: lastName,
                    user_email: email
                });

                updateUser.save(null, {
                    method: 'PUT',
                    success: function(model, response) {
                        console.log('User details updated successfully');
                        this.model.set(updateUser.attributes);
                        this.closeEditMode();
                    }.bind(this),
                    error: function(model, response) {
                        console.error('Error updating user details:', response.statusText);
                        var responseData = JSON.parse(response.responseText);
                        var errorsHtml = responseData.error;
                        var errors = $(errorsHtml).text();
                        alert('Validation Errors:\n' + errors);
                    }
                });
            } else {
                console.log('No changes detected.');
                this.closeEditMode();
            }
        }
	});

	var detailSection = new UserDetailView();

	function togglePasswordVisibility(inputId) {
		var input = document.getElementById(inputId);
		var icon = input.nextElementSibling;
		
		if (input.type === "password") {
			input.type = "text";
			icon.classList.remove('bx-hide');
			icon.classList.add('bx-show');
		} else {
			input.type = "password";
			icon.classList.remove('bx-show');
			icon.classList.add('bx-hide');
		}
	}
</script>
