# SprintAnalyzer 🏃‍♂️💨

**SprintAnalyzer** is a lightweight web application designed for track and field sprinters (100m, 200m, and 400m). It allows athletes to log their performances, normalize times by factoring in wind and altitude, and predict future race results using statistical analysis.

## ✨ Features

* 📊 **Performance Tracking**: Log your race times, wind readings, altitude, and dates.
* 🌬️ **Time Normalizer**: Calculate your "Basic Time" (sea-level, zero-wind equivalent) by stripping away environmental advantages using physics-based models.
* 🔮 **Race Simulator**: Predict your performance under specific environmental conditions (e.g., *"What would I run at 2000m altitude with a +2.0m/s tailwind?"*).
* 📈 **Predictive Algorithm**: A REST API analyzes your 12-month race history to forecast your next performance (Best Case, Target, and Average scenarios).
* 📱 **Responsive UI**: A clean, card-based interface built with Vanilla CSS (Flexbox) for both desktop and mobile.

## 🛠️ Tech Stack

* **Frontend**: HTML5, CSS3, JavaScript
* **Backend**: PHP
* **Database**: MySQL

## 🧮 Physics Models

The application applies distance-specific mathematical coefficients to evaluate aerodynamic drag and hypoxia:

* **100m & 200m**: Applies a quadratic model for wind resistance and a linear model for air density.
* **400m**: Automatically ignores wind readings, focusing solely on the ratio between aerodynamic advantage and oxygen debt (hypoxia) at higher altitudes.

---
*Pweb Project, Unipi 2026*
