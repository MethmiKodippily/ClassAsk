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
    <button class="profile-btn deleteUser" type="button">Delete Account</button>
</div>
</section>

<script src="/assets/js/account.js"></script>