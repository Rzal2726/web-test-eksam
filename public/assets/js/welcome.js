if(!localStorage.getItem('token') || !localStorage.getItem('username')){
    alert('Sesi sudah habis, silahkan login kembali')
    window.location.href = '/';
}
const endpoints = {
    question: "https://api-test.eksam.cloud/api/v1/tryout/question",
};
getQuestions()
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
            return true
        } else {
            throw new Error(data.message);
        }
    } catch (e) {
        console.log("Gagal mengambil data:", e);
        alert('Sesi sudah habis, silahkan login kembali')
        window.location.href = '/';
    }
}