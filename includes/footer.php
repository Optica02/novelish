<footer class="px-20 py-10">
    <div class="flex items-center justify-between">
        <div>
            <div class="w-[200px]">
                <img src="logo.jpeg" alt="">
            </div>
            <div>
                <p>Novelis is a online book ecommerce platform </p>
            </div>
        </div>
        <div class="px-10">
                <div class="px-2 my-4">
                    <p class="text-lg font-bold">Novelis Pvt.Ltd</p>
                </div>

                <div class="px-2">
                    <p class="text-lg">contact: +977–01–4445751</p>
                    <p class="text-lg">Email : info@novelis.com</p>
                </div>

                <div class="my-2">
                    <h1 class="text-xl font-bold">Social Media</h1>
                    <div class="my-2">
                        <a href="" class="hover:-translate-y-5 hover:text-blue-600"><i class="fab fa-facebook text-2xl mx-4"></i></a>
                        <a href="" class="hover:-translate-y-5 hover:text-pink-600"><i class="fab fa-instagram text-2xl mx-4"></i></a>
                        <a href="" class="hover:-translate-y-5 hover:text-blue-400"><i class="fab fa-twitter text-2xl mx-4"></i></a>
                        <a href="" class="hover:-translate-y-5 hover:text-red-500"><i class="fab fa-youtube text-2xl mx-4"></i></a>
                    </div>
                </div>
            </div>
    </div>

</footer>
</body>

<!-- toast script -->
<script>
    <?php
        if (isset($_SESSION['alert']))
        {
            $response = json_encode($_SESSION['alert']);
            echo "
            showToast($response);
            unsetSession();
            
            ";
    
        }
    ?>
    function showToast(response)
    {
        console.log(response.status);
        var toast = document.getElementById('toast');
        var toastStatus = document.getElementById('toastStatus');
        var toastTitle = document.getElementById('toastTitle');
        var toastMessage = document.getElementById('toastMessage');
        var toastProgressBar = document.getElementById('toastProgressBar');
        if(response.status =="success")
        {
            toastStatus.innerHTML='<i class="fas fa-check"></i>';
            toastStatus.classList.add('success');
            toast.classList.add('success');
        }
        else
        {
            toastStatus.innerHTML='<i class="fa fa-times"></i>';
            toastStatus.classList.add('error');
            toast.classList.add('error');
        }
        toastTitle.innerHTML=response.status;
        toastMessage.innerHTML=response.message;
        toast.classList.add('show');
        toastProgressBar.style.width = '100%';
        toastProgressBar.style.width = '0%';
        setTimeout(function()
        {
            toast.classList.remove('show');
        }, 3000);
    }
    function unsetSession()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'unset_session.php', true);
        xhr.send();
    }
</script>
<!-- end of toast script -->

</html>