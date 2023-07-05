//Today's Card Variables:
let mark = document.getElementById("today"),
  markDate = document.getElementById("today-date"),
  cityLocation = document.getElementById("location"),
  markDegree = document.getElementById("today-degree"),
  markIcon = document.getElementById("today-icon"),
  description = document.getElementById("today-description"),
  humidty = document.getElementById("humidty"),
  wind = document.getElementById("wind"),
  compass = document.getElementById("compass"),
  marksearchBar = document.getElementById("marksearch-bar");

//Next Days Variables:
let nextDay = document.getElementsByClassName("nextDay"),
  nextDayIcon = document.getElementsByClassName("nextDay-icon"),
  maxDegree = document.getElementsByClassName("max-degree"),
  minDegree = document.getElementsByClassName("min-degree"),
  nextDayDescription = document.getElementsByClassName("nextDay-description"),
  apiResponse,
  responseData,
  monthName = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Spt', 'Oct', 'Nov', 'Dec'],
  days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];
console.log(nextDay);
// currentCity = "machakos",


async function getWeatherData(currentCity = 'machakos') {
  apiResponse = await fetch(`https://api.weatherapi.com/v1/forecast.json?key=572e08fb1d7547f58d8151525211205&q=${currentCity}&days=3`)
  responseData = await apiResponse.json()
  console.log(responseData);
  displayTodayWeather();
  displayNextDayWeather();
  console.log(apiResponse);

}

getWeatherData();


function displayTodayWeather() {
  let date = new Date();
  mark.innerHTML = days[date.getDay()];
  markDate.innerHTML = `${date.getDate()} ${monthName[date.getMonth()]}`;
  cityLocation.innerHTML = responseData.location.name;
  markDegree.innerHTML = responseData.current.temp_c;
  markIcon.setAttribute("src", `https:${responseData.current.condition.icon}`)
  description.innerHTML = responseData.current.condition.text;
  wind.innerHTML = responseData.current.wind_kph;
  compass.innerHTML = responseData.current.wind_dir;
  humidty.innerHTML = responseData.current.humidity;

}


function displayNextDayWeather() {
  for (let i = 0; i < nextDay.length; i++) {
    nextDay[i].innerHTML = days[new Date(responseData.forecast.forecastday[i + 1].date).getDay()];
    nextDayIcon[i].setAttribute('src', `https:${responseData.forecast.forecastday[i + 1].day.condition.icon}`)
    maxDegree[i].innerHTML = responseData.forecast.forecastday[i + 1].day.maxtemp_c;
    minDegree[i].innerHTML = responseData.forecast.forecastday[i + 1].day.mintemp_c;
    nextDayDescription[i].innerHTML = responseData.forecast.forecastday[i + 1].day.condition.text;
  }
}

marksearchBar.addEventListener("keyup", function () {
  currentCity = marksearchBar.value;
  getWeatherData(currentCity);
})
