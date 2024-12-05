    <?php ob_start(); ?>
    <?php
    include "logindbase.php";

    $headeruser_id = $_SESSION['user_id'];
    // Fetch user data
    $sql = "SELECT firstname, lastname, EmailAddress, ContactNumber FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $headeruser_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <style>
            .header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 900;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: white; /* Semi-transparent white */
                padding: 15px 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            }

            .header .profile {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-left: auto;
            }

            .header .profile img {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                cursor: pointer;
            }

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: 2000;
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                background: white;
                border-radius: 20px;
                padding: 20px;
                width: 700px;
                max-width: 90%;
                height: auto;
                position: relative;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .profile-card,
            .profile-details {
                background: #1a1a1a;
                border-radius: 15px;
                padding: 20px;
                width: 45%;
                color: #ccc;
                display: flex; /* Enable Flexbox */
                flex-direction: column; /* Align content vertically */
                align-items: center; /* Center content horizontally */
                justify-content: center; /* Center content vertically */
                margin: 10px auto; /* Center the card horizontally inside its container */
            }

            .profile-card img {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                margin-bottom: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            }

            .profile-card h3 {
                margin: 10px 0;
                font-size: 1.5em;
                color: #ff758c;
                text-align: center; /* Center align text */
            }

            .profile-card p {
                font-size: 1em;
                color: #bbb;
                text-align: center; /* Center align text */
            }

            .profile-details h3 {
                font-size: 1.5em;
                margin-bottom: 15px;
                color: #ff758c;
                text-align: center; /* Center align text */
            }

            .profile-details p {
                margin: 5px 0;
                font-size: 1em;
                text-align: center; /* Center align text */
            }

            .initials-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #ff758c;
        color: white;
        font-size: 2em;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        margin-bottom: 10px;
        text-transform: uppercase;
    }



            .close-btn {
                position: absolute;
                top: 10px;
                right: 20px;
                background: #ff758c;
                color: white;
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                font-size: 1.2em;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            .close-btn:hover {
                background: #ff4a68;
            }

            /* Media Queries for Responsiveness */
            @media (max-width: 768px) {
                .modal-content {
                    flex-direction: column;
                    align-items: center;
                    width: 90%;
                    padding: 15px;
                }

                .profile-card,
                .profile-details {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .profile-card img {
                    width: 100px;
                    height: 100px;
                }

                .profile-card h3 {
                    font-size: 1.2em;
                }

                .profile-details h3 {
                    font-size: 1.2em;
                }

                .close-btn {
                    top: 10px;
                    right: 10px;
                }
            }

            @media (max-width: 480px) {
                .profile-card img {
                    width: 80px;
                    height: 80px;
                }

                .profile-card h3 {
                    font-size: 1em;
                }

                .profile-details h3 {
                    font-size: 1em;
                }

                .profile-details p {
                    font-size: 0.9em;
                }
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="profile">
                <i class="fas fa-bell"></i>
                <img id="userIcon" src="img/icons/user.png" alt="Profile">
            </div>
        </div>

        <!-- Modal -->
        <div id="userModal" class="modal">
        <div class="modal-content">
                        <button class="close-btn" id="closeModal">&times;</button>
                        <!-- Left: Profile Card -->
                        <div class="profile-card">
                <?php if ($user): ?>
                    <div class="initials-circle">
                    <?php
                    $firstnameInitial = !empty($user['firstname']) ? strtoupper($user['firstname'][0]) : '';
                    $lastnameInitial = !empty($user['lastname']) ? strtoupper($user['lastname'][0]) : '';
                    echo htmlspecialchars($firstnameInitial . $lastnameInitial);
                ?>
                    </div>
                <?php else: ?>
                    <img src="https://via.placeholder.com/120" alt="Guest">
                <?php endif; ?>
                <h3>Welcome 
                    <?php 
                        echo $user ? htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) : 'Guest';
                    ?>
                </h3>
            </div>

                <!-- Right: Profile Details -->
                <div class="profile-details">
                    <h3>Profile Details</h3>
                    <p><strong>Full Name:</strong> <?php 
                            echo $user ? htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) : 'N/A'; 
                        ?>
                    </p>
                    <p><strong>Email:</strong> <?php echo isset($user['EmailAddress']) ? htmlspecialchars($user['EmailAddress']) : 'N/A';
    ?></p>
                    <p><strong>Contact Number:</strong> <?php echo isset($user['ContactNumber']) ? htmlspecialchars($user['ContactNumber']) : 'N/A';
    ?></p>
                    
                </div>
            </div>
        </div>

        <script>
            const userIcon = document.getElementById('userIcon');
            const userModal = document.getElementById('userModal');
            const closeModal = document.getElementById('closeModal');

            // Show modal when user icon is clicked
            userIcon.addEventListener('click', () => {
                userModal.style.display = 'flex';
            });

            // Hide modal when close button is clicked
            closeModal.addEventListener('click', () => {
                userModal.style.display = 'none';
            });

            // Hide modal when clicking outside the modal content
            window.addEventListener('click', (event) => {
                if (event.target === userModal) {
                    userModal.style.display = 'none';
                }
            });
        </script>
    </body>

    </html>
    <?php ob_end_flush(); ?>
