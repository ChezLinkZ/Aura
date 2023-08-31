<!DOCTYPE html>
<html>
<head>
    <title>Database</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Consolas, monospace;
            white-space: pre;
        }
    </style>
</head>
<body>
    <pre id="console"></pre>
    <script>
        async function updateConsole() {
            const consoleElement = document.getElementById("console");

            try {
                const response = await fetch('/console_logger.php');
                const text = await response.text();
                consoleElement.innerHTML = text;
            } catch (error) {
                console.error(error);
            }

            setTimeout(updateConsole, 1000); // Update every second
        }

        updateConsole();
    </script>
</body>
</html>
