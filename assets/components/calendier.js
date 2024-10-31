import React, { useState } from "react";

function Calendar() {
    const[currentDate, setCurrentDate] = useState(new Date());

    const getDaysInMonth = (month, year) => {
        return new Date (year, month + 1, 0).getDate();
    }

    const generateDays = () => {
        const daysInMonth = getDaysInMonth(currentDate.getMonth(), currentDate.getFullYear());
        const daysArray = [];
        for (let day = 1; day <= daysInMonth; day++) {
          daysArray.push(day);
        }
        return daysArray;
      };
     
    
  // Fonctions pour changer de mois
  const prevMonth = () => {
    setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1));
  };

  const nextMonth = () => {
    setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1));
  };

  const monthNames = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
  ];

  return (
    <div className="calendar">
      <div className="header">
        <button onClick={prevMonth}>&#10094;</button>
        <h2>{monthNames[currentDate.getMonth()]} {currentDate.getFullYear()}</h2>
        <button onClick={nextMonth}>&#10095;</button>
      </div>
      <div className="days-of-week">
        {['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'].map(day => (
          <div key={day} className="day-name">{day}</div>
        ))}
      </div>
      <div className="days">
        {generateDays().map(day => (
          <div key={day} className="day">{day}</div>
        ))}
      </div>
    </div>
  );
}

export default Calendar;  

