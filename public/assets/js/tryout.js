if(!localStorage.getItem('token') || !localStorage.getItem('username')){
    alert('Sesi sudah habis, silahkan login kembali')
    window.location.href = '/';
}

const endpoints = {
    question: "https://api-test.eksam.cloud/api/v1/tryout/question",
    option: "https://api-test.eksam.cloud/api/v1/tryout/question-option",
    report: "https://api-test.eksam.cloud/api/v1/tryout/lapor-soal/create",
    show_question: "https://api-test.eksam.cloud/api/v1/tryout/question/",
    logout: "https://api-test.eksam.cloud/api/v1/auth/logout",
};

let Questions = [];
let CurrentQuestion = 1;
let CurrentQuestionId;
let CurrentQuestionData = [];
let MaxNum;
let nilai;
let correct;

init();

async function init() {
    await getQuestions();
    await getQuestion(CurrentQuestion);
    setQuestion(CurrentQuestionData);
    enableUnselectableRadios();
    updateNavigationButtons();
}

async function getQuestions() {
    try {
        const response = await fetch(endpoints.question, {
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });

        const data = await response.json();

        if (response.ok) {
            Questions = data.data;
            MaxNum = Questions.length;
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log("Gagal mengambil data soal:", e);
    }
}


async function getQuestion(num) {
    try {
        const response = await fetch(endpoints.show_question + num, {
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
        const data = await response.json();
        if (response.ok) {
            CurrentQuestionData = data.data;
            CurrentQuestionId = data.data.id;
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log("Gagal mengambil soal:", e);
    }
}

async function setQuestion(Data) {
    const QuestionCard = document.getElementById('soal-card');
    const OptionsCard = document.getElementById('option-card');
    const Options = Data.tryout_question_option;
    CurrentQuestionId = Data.id;

QuestionCard.innerHTML = `
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5><b>Soal No. ${Data.no_soal}</b></h5>
        <button
            type="button"
            class="btn btn-warning btn-sm text-white"
            data-bs-toggle="modal"
            data-bs-target="#modalId"
        >
            <i class="bx bx-message-square-error me-2"></i><span>Lapor</span>
        </button>
    </div>
    <div>${Data.soal}</div>
`;


    OptionsCard.innerHTML = Options.map((data, index) => `
        <div class="card my-2">
            <div class="card-body d-flex align-items-center">
                <input class="form-check-input me-2" type="radio" name="jawaban" id="option${index}" value="${data.inisial}">
                <label class="form-check-label w-100" for="option${index}">
                    ${data.inisial}. ${data.jawaban}
                </label>
            </div>
        </div>
    `).join('');

    // Tampilkan jawaban yang sudah dipilih
    const savedAnswers = JSON.parse(localStorage.getItem('answers') || '{}');
    console.log(savedAnswers)
    if (savedAnswers[CurrentQuestionId]) {
        console.log(savedAnswers[CurrentQuestionId])
        const selected = document.querySelector(`input[name="jawaban"][value="${savedAnswers[CurrentQuestionId].jawaban}"]`);
        if (selected) selected.checked = true;
    }
}

function enableUnselectableRadios() {
    const radios = document.querySelectorAll('input[type="radio"][name="jawaban"]');
    radios.forEach((radio) => {
        radio.addEventListener('mousedown', function () {
            this.wasChecked = this.checked;
        });
        radio.addEventListener('click', function () {
            if (this.wasChecked) {
                this.checked = false;
            }
        });
        radio.addEventListener('change', function () {
            const selectedInisial = this.value;
            const selectedOption = CurrentQuestionData.tryout_question_option.find(opt => opt.inisial === selectedInisial);

            if (selectedOption) {
                saveAnswer(CurrentQuestionData.id, {
                    jawaban: selectedInisial,
                    nilai: selectedOption.nilai,
                    benar: selectedOption.iscorrect === 1
                });
            }
        });
    });
}


function saveAnswer(questionId, answer) {
    let savedAnswers = JSON.parse(localStorage.getItem('answers') || '{}');
    savedAnswers[questionId] = answer;
    localStorage.setItem('answers', JSON.stringify(savedAnswers));
}

async function nextQuestion() {
    try {
        const next = CurrentQuestion + 1;
        if (CurrentQuestion >= MaxNum) return;

        JsLoadingOverlay.show();

        const response = await fetch(endpoints.show_question + next, {
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
        const data = await response.json();

        if (response.ok) {
            CurrentQuestion = next;
            CurrentQuestionData = data.data;
            CurrentQuestionId = data.data.id;
            await setQuestion(CurrentQuestionData);
            enableUnselectableRadios();
            updateNavigationButtons();
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log(e);
    } finally {
        JsLoadingOverlay.hide();
    }
}

async function prevQuestion() {
    try {
        const prev = CurrentQuestion - 1;
        if (CurrentQuestion <= 1) return;

        JsLoadingOverlay.show();

        const response = await fetch(endpoints.show_question + prev, {
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
        const data = await response.json();

        if (response.ok) {
            CurrentQuestion = prev;
            CurrentQuestionData = data.data;
            CurrentQuestionId = data.data.id;
            await setQuestion(CurrentQuestionData);
            enableUnselectableRadios();
            updateNavigationButtons();
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log(e);
    } finally {
        JsLoadingOverlay.hide();
    }
}

function updateNavigationButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    prevBtn.disabled = CurrentQuestion <= 1;

    if (CurrentQuestion >= MaxNum) {
        // Ubah ke tombol "Selesai"
        nextBtn.textContent = "Selesai";
        nextBtn.classList.remove('btn-primary');
        nextBtn.classList.add('btn-success');
        nextBtn.onclick = async function () {
            Swal.fire({
                title: "Yakin ingin mengakhiri ujian?",
                text: "Setelah submit, kamu tidak bisa mengubah jawaban lagi.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, selesai!",
                cancelButtonText: "Batal"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await showScore()
                }
            });
        };
    } else {
        // Tombol next biasa
        nextBtn.textContent = "Selanjutnya";
        nextBtn.classList.remove('btn-success');
        nextBtn.classList.add('btn-primary');
        nextBtn.onclick = nextQuestion;
    }
}

async function showScore() {
    const totalScore = await calculateTotalScore();
    localStorage.setItem('last-score', totalScore.nilai);
    Swal.fire({
        title: "Tes Selesai!",
        text: `Nilai kamu: ${totalScore.nilai} dari ${totalScore.maxNilai}`,
        icon: "success",
        showCancelButton: true,
        confirmButtonText: 'Selesai (Keluar)',
        cancelButtonText: 'Ulangi Tes',
        draggable: true,
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
    }).then(async (result) => {
        if (result.isConfirmed) {
            JsLoadingOverlay.show();
            localStorage.removeItem('answers');
            window.location.href = '/tryout';
            JsLoadingOverlay.hide();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            reset();
        }
    });
}


async function reset() {
    localStorage.removeItem('answers')
    location.reload();
}


function getMaxPossibleScore() {
    let maxScore = 0;
    Questions.forEach(soal => {
        // Cari nilai tertinggi dari opsi soal tersebut
        let maxNilaiPerSoal = Math.max(...soal.tryout_question_option.map(opt => opt.nilai));
        maxScore += maxNilaiPerSoal;
    });
    return maxScore;
}

function getCorrectAnswerCount() {
    const savedAnswers = JSON.parse(localStorage.getItem('answers') || '{}');
    let correctCount = 0;
    for (let key in savedAnswers) {
        if (savedAnswers[key].benar) correctCount++;
    }
    return correctCount;
}

function calculateTotalScore() {
    const savedAnswers = JSON.parse(localStorage.getItem('answers') || '{}');
    let totalNilai = 0;
    let totalBenar = 0;

    for (let key in savedAnswers) {
        totalNilai += savedAnswers[key].nilai || 0;
        if (savedAnswers[key].benar) totalBenar++;
    }

    let totalSoal = Questions.length;
    let maxNilai = getMaxPossibleScore();

    return {
        nilai: totalNilai,
        benar: totalBenar,
        totalSoal: totalSoal,
        maxNilai: maxNilai
    };
}


async function report() {
    try {
        let id = CurrentQuestionId;
        let laporan = document.getElementById('editor1').value;
        const response = await fetch(endpoints.report, {
            method: "POST",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'content-type': 'application/json'
            },
            body: JSON.stringify({
                tryout_question_id: id,
                laporan: laporan,
            })
        });
        const data = await response.json();
        if (response.ok) {
            toastr.success("Berhasil melaporkan soal")
            document.getElementById('editor1').value = "";
            $("#modalId").modal('hide')
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log("Gagal mengambil data soal:", e);
    }
}

