<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=<?= base_url('assets/order.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Halaman Order</title>

</head>
<body>
    <div class="container">
    <span class=back-btn>
    <a href= <?= base_url('service/dashboard')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h3>Pesan Layanan Pada Bengkel Yang Anda Pilih</h3>

        <form action=<?= base_url('service/auth_order'); ?>  method="post">
        <label for="nohp">No. Whatsapp</label>
        <input type="number" name="nohp" id='nohp' style="width:50%;"value="" placeholder="628xxxxxxx">
        <label for="description">Deskripsi / Keluhan</label>
        <textarea name="description" id="description" cols="60" rows="10" style="resize: none"></textarea>
        <span class="span-check" style="display:flex;">
        <input type="checkbox" id="acc-radio" name="acc-radio" >
        <label for="acc-radio"> Data yang sudah saya masukkan adalah benar</label><br>
        </span>
        <input type="submit" name="submit" value="submit" class="buttonSubmit" />
        </form>
        <button class="btn-submit" type="submit" id="save-button" onclick="onClickSave()" value="Submit" disabled="disabled"><i class="bi bi-save"  style="display:flex;align-items:center;padding-right:10px;color:red;"></i>Mulai Layanan</button>

        <script>
        const body = document.querySelector('body');
        const container = body.querySelector('.container');
        const btnsubmit = container.querySelector('.btn-submit');
        const form  = container.querySelector("form");
        const nohp  = form.querySelector("#nohp");
        const description  = form.querySelector("#description");
        const checkbutton  = form.querySelector("#acc-radio");
        const buttonSubmit = form.querySelector('.buttonSubmit')
        function updateSubmitBtn(){
        const nohpValue = nohp.value.trim();
        const descriptionValue = description.value.trim();
        const checkbuttonValue = checkbutton.checked;
        if(nohpValue && descriptionValue && checkbuttonValue){
            btnsubmit.removeAttribute('disabled');
        }else {
            btnsubmit.setAttribute('disabled', 'disabled');
        }
        }

        nohp.addEventListener('change', updateSubmitBtn);
        description.addEventListener('change', updateSubmitBtn);
        checkbutton.addEventListener('change', updateSubmitBtn);
        
    function onClickSave(){
        Swal.fire({
    title: 'Cek Data Anda <h4>Data anda akan dikirimkan ke bengkel tujuan</h4>',
    html: `<p>Nama Anda :</p> <p class="value-attr"><?php echo session()->get('name'); ?></p>`
    + `<p>Nama Bengkel Tujuan :</p> <p class="value-attr"><?php echo session()->get('nama_bengkel'); ?></p>`
    + `<p>Alamat / Letak anda saat ini: </p><p class="value-attr"><?php echo session()->get('address'); ?></p>`
    + `<p>No.Hp Anda:</p> <p class="value-attr">` +nohp.value
    + '</p><p>Deskripsi Permasalahan:</p> <p class="value-attr">' + description.value+ '</p>',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: `Yes`,
    cancelButtonText: 'Ulangi',
    }).then((result) => {
    if (result.isConfirmed) {
     buttonSubmit.click()
    }else{
        swal.close();
    }
});
    }

</script>
</body>
</html>