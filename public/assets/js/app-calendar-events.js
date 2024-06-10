/**
 * App Calendar Events
 */

'use strict';

let date = new Date();
let nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
let nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
let prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

let events = [
  {
    id: 1,
    url: '',
    title: 'Online Japanese N5 Training',
    start: date,
    end: nextDay,
    allDay: false,
    extendedProps: {
      calendar: 'Business'
    }
  },
  {
    id: 2,
    url: '',
    title: 'Online Japanese N4 Training',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    allDay: true,
    extendedProps: {
      calendar: 'Business'
    }
  },
  {
    id: 3,
    url: '',
    title: 'Online Japanese Conversation Class',
    allDay: true,
    start: new Date(date.getFullYear(), date.getMonth() + 1, -9),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -7),
    extendedProps: {
      calendar: 'Holiday'
    }
  },
  {
    id: 4,
    url: '',
    title: "Online Japanese Conversation Class",
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    extendedProps: {
      calendar: 'Personal'
    }
  },
  {
    id: 5,
    url: '',
    title: 'Online Japanese N5 Training',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'ETC'
    }
  },
  {
    id: 6,
    url: '',
    title: 'Online Japanese Conversation Class',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'Personal'
    }
  },
  {
    id: 7,
    url: '',
    title: 'Online Japanese Conversation Class',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'Family'
    }
  },
  {
    id: 8,
    url: '',
    title: 'Online Japanese N4 Training',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'Business'
    }
  },
  {
    id: 9,
    url: '',
    title: 'Online Japanese Conversation Class',
    start: nextMonth,
    end: nextMonth,
    allDay: true,
    extendedProps: {
      calendar: 'Business'
    }
  },
  {
    id: 10,
    url: '',
    title: 'Online Japanese N5 Training',
    start: prevMonth,
    end: prevMonth,
    allDay: true,
    extendedProps: {
      calendar: 'Personal'
    }
  }
];
