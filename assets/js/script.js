var currentPlaylist = []
var audioElement

function formatTime(second){
    let time = Math.round(second)
    let minutes = Math.floor(time / 60)
    let seconds = time - minutes * 60
    let extraZero = seconds < 10 ? "0" : ""
    return minutes + ":" + extraZero + seconds
}

function updateTimeProgressBar (audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime))
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime))

    let progress = audio.currentTime / audio.duration * 100
    $(".playbackBar .progress").css("width", progress + "%")
}
function Audio(){
    this.currentlyPlaying
    this.audio = document.createElement('audio')
    
    this.audio.addEventListener("canplay", function() {
        let duration = formatTime(this.duration)
        $(".progressTime.remaining").text(duration)
    })

    this.audio.addEventListener("timeupdate", function(){
        if(this.duration){
            updateTimeProgressBar(this)
        }
    })

    this.setTrack = (track) => {
        this.currentlyPlaying = track
        this.audio.src = track.path
    } 

    this.play = () => {
        this.audio.play()
    }
    
    this.pause = () => {
        this.audio.pause()
    }
}   