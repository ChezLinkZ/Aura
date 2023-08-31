

<?php
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB
// IMPORT THIS REPL TO GITHUB


session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"]; // Get the signed-in username
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    $message = $_POST["message"];
    $imagePath = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        // Handle image upload
        $imageDir = "images/uploads/";
        $imageName = $_FILES["image"]["name"];
        $imagePath = $imageDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Handle the message sending here
    $messages = isset($users[$username]["messages"]) ? $users[$username]["messages"] : [];
    $messages[] = [
        "message" => $message,
        "image" => $imagePath
    ];
    $users[$username]["messages"] = $messages;
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Aura</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
  
    <div class="navbar">
    <img src="logo.png" class="logo">
    <button><img src="images/assets/auraplus.png"></button>
    <button><img src="images/a ssets/settings.png"></button>
    <a href="logout.php"><button style="margin-right: 80px;width: 180px;"><img src="images/assets/logout.png"></button></a>
</div>
    <div class="chat-container">
        <div class="chat" id="messages">
            <!-- Messages will be displayed here -->
        </div>
    </div>
    <div class="input-box">
        <form id="message-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="input">
        <label for="image-upload">
            <img src="images/assets/add.svg" id="add-image-button">
        </label>
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="text" name="message" placeholder="Type your Message" autocomplete="off">
        <input type="file" name="image" id="image-upload" style="display: none;">
    </div>
    <button type="submit"><img src="images/assets/send.svg"></button>
</form>
    </div>

<div class="sidebar"><h1>Online</h1><hr><ul id="online-users">
        <!-- Online users will be listed here -->
    </ul></div>
  
<div id="contextMenu" class="context-menu"
	style="display: none">
	<ul>
		<li><a href="#">Element-1</a></li>
		<li><a href="#">Element-2</a></li>
		<li><a href="#">Element-3</a></li>
		<li><a href="#">Element-4</a></li>
		<li><a href="#">Element-5</a></li>
		<li><a href="#">Element-6</a></li>
		<li><a href="#">Element-7</a></li>
	</ul>
</div>
<script>

// Update user's status on connection
fetch('update_user_status.php'); // Replace with your PHP script to update status

// Update user's status on page unload
window.addEventListener("beforeunload", function () {
    fetch('update_user_status.php'); // Replace with your PHP script to update status
});






// my embed code:
// dosent work
// you can use as starting point


    // Function to update messages from chat.json
    function updateMessages() {
        const messagesContainer = document.getElementById("messages");

        // Fetch messages from chat.json using Fetch API
        fetch("chat.json")
            .then(response => response.json())
            .then(messages => {
                // Clear existing messages
                messagesContainer.innerHTML = "";

                // Append updated messages
                messages.forEach(message => {
                    const messageElement = document.createElement("div");
                    messageElement.classList.add("message");

                    // Check if the message contains an image URL
                    if (message.message.match(/\.(jpeg|jpg|gif|png)$/) !== null) {
                        // If it's an image URL, create an image element
                        const imageElement = document.createElement("img");
                        imageElement.src = message.message;
                        messageElement.appendChild(imageElement);
                    } else {
                        // If it's a regular message, display text
                        messageElement.textContent = message.username + ": " + message.message;
                    }

                    messagesContainer.appendChild(messageElement);
                });

            });
    }




// end of my embed code









  
  
	document.onclick = hideMenu;
	document.oncontextmenu = rightClick;
	
	function hideMenu() {
		document.getElementById("contextMenu")
				.style.display = "none"
	}

	function rightClick(e) {
		e.preventDefault();

		if (document.getElementById("contextMenu")
				.style.display == "block")
			hideMenu();
		else{
			var menu = document.getElementById("contextMenu")

			menu.style.display = 'block';
			menu.style.left = e.pageX + "px";
			menu.style.top = e.pageY + "px";
		}
	}
</script>
<style type="text/css">
    .context-menu {
        position: absolute;
        text-align: center;
        background: lightgray;
        border: 1px solid black;
    }
  
    .context-menu ul {
        padding: 0px;
        margin: 0px;
        min-width: 150px;
        list-style: none;
    }
  
    .context-menu ul li {
        padding-bottom: 7px;
        padding-top: 7px;
        border: 1px solid black;
    }
  
    .context-menu ul li a {
        text-decoration: none;
        color: black;
    }
  
    .context-menu ul li:hover {
        background: darkgray;
    }
</style>
    <script>
        const messagesContainer = document.getElementById("messages");
        const inputBox = document.querySelector('input[name="message"]');
        const messageForm = document.getElementById("message-form");
        let previousChatLength = 0; // Variable to store previous chat length


      function userTags(text) {
  const tagPattern = /(@\S+)/g;
  return text.replace(tagPattern, '<span class="user-tag">$1</span>');
}

      function boldifyText(text) {
  return text.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>').replace(/\*(.*?)\*/g, '<i>$1</i>');
}

        // Function to fetch and display messages
        function fetchAndDisplayMessages() {
    fetch("chat.json")
        .then(response => response.json())
        .then(messages => {
            messagesContainer.innerHTML = "";
            messages.forEach(message => {
                const messageElement = document.createElement("div");
                messageElement.classList.add("message");
                messageElement.classList.add("animate__backInUp");
                messageElement.classList.add("animate__animated");

                const pfpImage = document.createElement("img");
                pfpImage.classList.add("pfp");
                pfpImage.src = "profile.gif";
                pfpImage.alt = "Profile Picture";
                

                const messageContent = document.createElement("div");
                messageContent.classList.add("message-content");
                
                // Convert URLs to anchor tags
                const messageText = message.message;
                const anchorRegex = /((http|https):\/\/[^\s]+)/g;
                const messageHTML = boldifyText(userTags(messageText.replace(anchorRegex, '<a href="$1" target="_blank">$1</a>')));
                
                messageContent.innerHTML = messageHTML;

                const nameElement = document.createElement("span");
                nameElement.classList.add("name");
                nameElement.innerHTML = message.username;
                if (message.username == "ChezLinkZ") {
                  nameElement.style.color = "#edcf28";
                }
              if (message.username == "Bhop") {
                  nameElement.style.color = "#33eeff";
                }
              
              messageElement.appendChild(nameElement);
              messageElement.appendChild(pfpImage);
                messageElement.appendChild(messageContent);
              
              

                messagesContainer.appendChild(messageElement);
            });

            const currentChatLength = messages.length;

            if (previousChatLength !== currentChatLength) {
                scrollToBottom();
            }

            previousChatLength = currentChatLength; // Update previous chat length
        });
}

      
        // Function to send a new message
        function sendMessage(message) {
            fetch("send_message.php", {
                method: "POST",
                body: new URLSearchParams({
                    username: "<?php echo $username; ?>",
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchAndDisplayMessages(); // Fetch and display updated messages
                    inputBox.value = ""; // Clear the input box
                }
            });
          inputBox.value = "";
          fetchAndDisplayMessages()
        }

        // Event listener for form submission
        messageForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const message = inputBox.value.trim();
            if (message !== "") {
                sendMessage(message);
            }
        });

        // Function to scroll to the bottom of the chat
        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Initial fetch and display messages
        fetchAndDisplayMessages();

        // Poll for new messages every second
        setInterval(fetchAndDisplayMessages, 300);

      // Function to update the list of online users in the sidebar
function updateOnlineUsers(onlineUsers) {
    const onlineUsersList = document.getElementById("online-users");
    onlineUsersList.innerHTML = ""; // Clear the list first

    // Create list items for each online user
    onlineUsers.forEach(user => {
        const userItem = document.createElement("li");
        userItem.textContent = user;
        onlineUsersList.appendChild(userItem);
    });
}


// Function to fetch and update the list of online users
function fetchOnlineUsers() {
    fetch("get_online_users.php") // Replace with your PHP script to fetch online users
        .then(response => response.json())
        .then(data => {
            updateOnlineUsers(data.onlineUsers);
        })
        .catch(error => {
            console.error("Error fetching online users:", error);
        });
}


// Poll for online users every 2 seconds
setInterval(fetchOnlineUsers, 200);


// Update user's status on connection
fetch('update_user_status.php');
    </script>

</body>
</html>


