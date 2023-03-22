</main>
<footer>
    <span>&copy; Moon's Collection&emsp;&emsp;</span>
    <?php if ($login_result["loggedin"]) {
        // echo "Welcome back, {$login_result['username']}";
        echo '<span>' . "Welcome back, {$login_result['username']}.&emsp;&emsp;" . '</span>';
    }
    ?>
    <a class="logout" href="./?logout">
        <span>Logout</span>
    </a>
</footer>
<script src="script.js"></script>
</body>

</html>