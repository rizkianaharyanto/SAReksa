
<div id="stepper" class="bs-stepper">
    <div class="bs-stepper-header">
        <div class="step" data-target="#test-l-1">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">
                    ID
                </span>
            </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#test-l-2">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Barang</span>
            </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#test-l-3">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Biaya Lain</span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">
        <div id="test-l-1" class="content ">
            {{ $test1 }}
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
            </div>
        </div>

        <div id="test-l-2" class="content">
            {{ $test2 }}
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
            </div>
        </div>
        <div id="test-l-3" class="content">
            {{ $test3 }}
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<script>
    var idnya= $("div").prop();
    console.log($idnya);
    var stepper1Node = document.querySelector('#'+idnya)
    var stepper1 = new Stepper(document.querySelector('#'+idnya))

    stepper1Node.addEventListener('show.bs-stepper', function(event) {
        console.warn('show.bs-stepper', event)
    })
    stepper1Node.addEventListener('shown.bs-stepper', function(event) {
        console.warn('shown.bs-stepper', event)
    })
</script>