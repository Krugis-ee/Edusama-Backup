<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>My Attendance</title>
  <meta name="description" content="" />
  @include('dashboard.header')
  <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/flatpickr/flatpickr.css')}}" />
  <script src="{{asset('assets/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/js/forms-pickers.js')}}"></script>

  <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $branch_id_jp = 0;
    $branch_id_jp = App\Models\User::getBranchID($user_id);
    $user_role_id = App\Models\User::getRoleID($user_id);
    ?>
  <style type="text/css">
    .parent_assessments #logo_color {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .parent_assessments .app-brand-logo.demo {
      width: auto !important;
      height: auto !important;
    }

    .parent_assessments .form-check-input:checked,
    .parent_assessments .form-check-input[type=checkbox]:indeterminate {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .parent_assessments .form-check-input:focus {
      border-color: <?php echo $org_color; ?> !important;
    }

    .parent_assessments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .parent_assessments .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .parent_assessments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .parent_assessments .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
      color: #ffffff !important;
    }

    .parent_assessments .menu-vertical .app-brand {
      margin: 20px 0.875rem 20px 1rem;
    }

    .parent_assessments .icon_resize {
      font-size: 17px !important;
    }

    .parent_assessments #layout-menu .icon_resize {
      margin-right: 10px;
    }

    .layout-navbar-fixed .layout-page:before {
      background: #0000000d;
      mask: none;
    }

    .parent_assessments #template-customizer .template-customizer-open-btn {
      display: none;
    }

    .table_admin select#dt-length-0 {
      margin-right: 10px !important;
    }

    .table_admin .dt-search .dt-input {
      margin-left: 14px !important;
    }

    .table_admin .dt-search .dt-input:focus,
    .table_admin .dt-length select.dt-input:focus {
      color: #6f6b7d;
      background-color: #fff;
      border-color: #7367f0;
      outline: 0;
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
    }

    .table_admin .dt-length select.dt-input {
      --bs-form-select-bg-img: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='%236f6b7d' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='white' stroke-opacity='0.2' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      padding: 0.422rem 2.45rem 0.422rem 0.875rem;
      font-size: 0.9375rem;
      font-weight: 400;
      line-height: 1.5;
      color: #6f6b7d;
      appearance: none;
      background-color: #fff;
      background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
      background-repeat: no-repeat;
      background-position: right 0.875rem center;
      background-size: 22px 20px;
      border: var(--bs-border-width) solid #dbdade;
      border-radius: var(--bs-border-radius);
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    table.dataTable.display tbody tr:hover > .sorting_1,
    table.dataTable.order-column.hover tbody tr:hover > .sorting_1,
    table.dataTable.display > tbody > tr:nth-child(odd) > .sorting_1,
    table.dataTable.order-column.stripe > tbody > tr:nth-child(odd) > .sorting_1,
    table.dataTable.stripe > tbody > tr:nth-child(odd) > *,
    table.dataTable.display > tbody > tr:nth-child(odd) > * {
      box-shadow: none !important;
    }

    .dt-layout-row {
      padding-bottom: 20px;
    }

    .table_admin th {
      color: #5d596c !important;
      font-weight: normal !important;
      text-transform: uppercase !important;
      font-size: 0.8125rem !important;
      letter-spacing: 1px !important;
    }

    .table_admin .dt-paging-button.current {
      background: rgba(75, 70, 92, 0.08) !important;
      border: 1px solid #aaa !important;
    }

    .table_admin .dt-paging-button.current:active {
      color: #6f6b7d !important;
      background-color: #fff !important;
      border-color: #7367f0 !important;
      outline: 0 !important;
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
    }

    tr td {
      text-align: center !important;
    }

    tr th {
      text-align: center !important;
    }

    .dt-empty {
      text-align: center !important;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      background-color: #fce4e4;
      border-color: #fce4e4;
      color: inherit !important;
    }

    .dropdown-item:not(.disabled).active,
    .dropdown-item:not(.disabled):active {
      background-color: <?php echo $org_color; ?>;
      color: #fff !important;
    }

    html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item:not(.active) > .menu-link:hover {
      background-color: #fce4e4 !important;
      border-color: #fce4e4 !important;
      color: inherit !important;
    }

    #pagetitle,
    #modalCenterTitle,
    #exampleModalLabel5,
    #exampleModalLabel1 {
      color: <?php echo $org_color; ?>;
    }
    /* Calendar container */

    .container-calendar {
      background: #ffffff;
      padding: 15px;
      margin: 0 auto;
      overflow: auto;
      /*      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);*/
      justify-content: space-between;
    }
    /* Event section styling */

    .container-calendar #left h1 {
      color: green;
      text-align: center;
      background-color: #f2f2f2;
      margin: 0;
      padding: 10px 0;
    }

    .event-marker {
      position: relative;
    }

    .event-marker::after {
      content: '';
      display: block;
      width: 6px;
      height: 6px;
      background-color: red;
      border-radius: 50%;
      position: absolute;
      bottom: 0;
      left: 0;
    }
    /* event tooltip styling */

    .event-tooltip {
      position: absolute;
      background-color: rgba(234, 232, 232, 0.763);
      color: black;
      padding: 10px;
      border-radius: 4px;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: none;
      transition: all 0.3s;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .event-marker:hover .event-tooltip {
      display: block;
    }
    /* Reminder section styling */

    #reminder-section {
      padding: 10px;
      background: #f5f5f5;
      margin: 20px 0;
      border: 1px solid #ccc;
    }

    #reminder-section h3 {
      color: green;
      font-size: 18px;
      margin: 0;
    }

    #reminderList {
      list-style: none;
      padding: 0;
    }

    #reminderList li {
      margin: 5px 0;
      font-size: 16px;
    }
    /* Buttons in the calendar */

    .button-container-calendar button {
      cursor: pointer;
      color: green;
      border: 1px solid green;
      border-radius: 4px;
      padding: 5px 10px;
      font-weight: bold;
    }
    /* Calendar table */

    .table-calendar {
      border-collapse: collapse;
      width: 100%;
    }

    .table-calendar td,
    .table-calendar th {
      padding: 5px;
      border: 1px solid #e2e2e2;
      text-align: center;
      vertical-align: top;
    }
    /* Date picker */

    .date-picker.selected {
      background-color: #f2f2f2;
      font-weight: bold;
      outline: 1px dashed #00BCD4;
      color: #000;
    }

    .date-picker.selected span {
      border-bottom: 2px solid currentColor;
    }
    /* Day-specific styling */
    /* Hover effect for date cells */

    .date-picker:hover {
      cursor: pointer;
    }

    .date-picker {
      background-color: #28c76f;
      color: #fff;
    }

    .date-picker[data-date="1"],
    .date-picker[data-date="7"],
    .date-picker[data-date="15"],
    .date-picker[data-date="20"],
    .date-picker[data-date="21"] {
      background-color: #ea5455;
      color: #fff;
    }

    .date-picker[data-date="8"],
    .date-picker[data-date="19"] {
      background-color: #ff9f43;
      color: #fff;
    }

    .date-picker:nth-child(1) {
      color: red !important;
      background-color: #fff;
      /* Sunday */
    }
    /* Header for month and year */

    #monthAndYear {
      text-align: center;
      margin-top: 0;
    }
    /* Navigation buttons */

    .button-container-calendar {
      position: relative;
      margin-bottom: 1em;
      overflow: hidden;
      clear: both;
    }

    #previous {
      float: left;
    }

    #next {
      float: right;
    }
    /* Footer styling */

    .footer-container-calendar {
      margin-top: 1em;
      border-top: 1px solid #dadada;
      padding: 10px 0;
    }

    .footer-container-calendar select {
      cursor: pointer;
      background: #ffffff;
      color: #585858;
      border: 1px solid #bfc5c5;
      border-radius: 3px;
      padding: 5px 1em;
    }

    .table-calendar th {
      font-weight: 700 !important;
    }
  </style>
</head>

<body class="parent_assessments">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('student_dashboard.sidebar')
      <div class="layout-page">
        <!-- Navbar -->
        @include('student_dashboard.navbar')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-ecommerce mb-4">
              <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                <div class="card-title mb-3 me-1">
                  <h4 class="mb-0 mt-3" id="pagetitle">My Attendance</h4>
                </div>
              </div>
            </div>
            <div class="card mb-4" id="filter_table">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3" id="subject_attendance">
                    <label class="form-label">Subject</label>
                    <select id="attendance_subject" class="form-select">
                      <option>-Select-</option>
                      <option value="1">Subject 1</option>
                      <option value="2">Subject 2</option>
                      <option value="3">Subject 3</option>
                    </select>
                  </div>

                  <div class="col-md-4" id="filter_date">
                    <div class="row">
                      <div class="col-md-4">
                        <label class="form-label">Filter By Month</label>
                        <select id="month" onchange="jump()" class="form-select" style="margin-right:10px;">
                          <option value=0>Jan</option>
                          <option value=1>Feb</option>
                          <option value=2>Mar</option>
                          <option value=3>Apr</option>
                          <option value=4>May</option>
                          <option value=5>Jun</option>
                          <option value=6>Jul</option>
                          <option value=7>Aug</option>
                          <option value=8>Sep</option>
                          <option value=9>Oct</option>
                          <option value=10>Nov</option>
                          <option value=11>Dec</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <!-- Dropdown to select a specific year -->
                        <label class="form-label">Filter By Year</label>
                        <select id="year" onchange="jump()" class="form-select"></select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-label-dark waves-effect mt-4" id="export_attendance" style="float:right;display: none !important;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card col-12" id="attendance_div">
              <div class="card-body table_admin text-nowrap">
                <div class="container-calendar">
                  <div id="right">
                    <h3 id="monthAndYear" class="mb-0"></h3>
                    <div class="button-container-calendar">
                      <button id="previous" onclick="previous()">
                        ‹
                      </button>
                      <button id="next" onclick="next()">
                        ›
                      </button>
                    </div>
                    <table class="table-calendar" id="calendar" data-lang="en">
                      <thead id="thead-month"></thead>
                      <!-- Table body for displaying the calendar -->
                      <tbody id="calendar-body"></tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="col-12">
                  <div class="row">
                    <div class="col-6">
                      <h5>Attendance Percentage: <b class="text-success">60%</b></h5>
                    </div>
                    <div class="col-6 d-sm-flex d-block justify-content-end">
                      <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                        <span class="badge badge-dot bg-success me-1"></span> Present
                      </div>
                      <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                        <span class="badge badge-dot bg-danger me-1"></span> Absent
                      </div>
                      <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                        <span class="badge badge-dot bg-warning me-1"></span> Half Day
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content -->
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  @include('dashboard.footer')

  <script type="text/javascript">
    $(document).ready(function() {
      $('#attendance_div').hide();
      $('#filter_date').hide();
      $('#export_attendance').hide();
      $('#subject_attendance').change(function() {

        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#attendance_div').show();
            $('#filter_date').show();
            $('#export_attendance').show();
          } else {
            $('#attendance_div').hide();
            $('#filter_date').hide();
            $('#export_attendance').hide();
          }

        });
      });
    });
  </script>



  <script type="text/javascript">
    // script.js

    // Define an array to store events
    let events = [];

    // letiables to store event input fields and reminder list
    let eventDateInput =
      document.getElementById("eventDate");
    let eventTitleInput =
      document.getElementById("eventTitle");
    let eventDescriptionInput =
      document.getElementById("eventDescription");
    let reminderList =
      document.getElementById("reminderList");

    // Counter to generate unique event IDs
    let eventIdCounter = 1;

    // Function to add events
    function addEvent() {
      let date = eventDateInput.value;
      let title = eventTitleInput.value;
      let description = eventDescriptionInput.value;

      if (date && title) {
        // Create a unique event ID
        let eventId = eventIdCounter++;

        events.push({
          id: eventId,
          date: date,
          title: title,
          description: description
        });
        showCalendar(currentMonth, currentYear);
        eventDateInput.value = "";
        eventTitleInput.value = "";
        eventDescriptionInput.value = "";
        displayReminders();
      }
    }

    // Function to delete an event by ID
    function deleteEvent(eventId) {
      // Find the index of the event with the given ID
      let eventIndex =
        events.findIndex((event) =>
          event.id === eventId);

      if (eventIndex !== -1) {
        // Remove the event from the events array
        events.splice(eventIndex, 1);
        showCalendar(currentMonth, currentYear);
        displayReminders();
      }
    }

    // Function to display reminders
    function displayReminders() {
      reminderList.innerHTML = "";
      for (let i = 0; i < events.length; i++) {
        let event = events[i];
        let eventDate = new Date(event.date);
        if (eventDate.getMonth() ===
          currentMonth &&
          eventDate.getFullYear() ===
          currentYear) {
          let listItem = document.createElement("li");
          listItem.innerHTML =
            `<strong>${event.title}</strong> -
      ${event.description} on
      ${eventDate.toLocaleDateString()}`;

          // Add a delete button for each reminder item
          let deleteButton =
            document.createElement("button");
          deleteButton.className = "delete-event";
          deleteButton.textContent = "Delete";
          deleteButton.onclick = function() {
            deleteEvent(event.id);
          };

          listItem.appendChild(deleteButton);
          reminderList.appendChild(listItem);
        }
      }
    }

    // Function to generate a range of
    // years for the year select input
    function generate_year_range(start, end) {
      let years = "";
      for (let year = start; year <= end; year++) {
        years += "<option value='" +
          year + "'>" + year + "</option>";
      }
      return years;
    }

    // Initialize date-related letiables
    today = new Date();
    currentMonth = today.getMonth();
    currentYear = today.getFullYear();
    selectYear = document.getElementById("year");
    selectMonth = document.getElementById("month");

    createYear = generate_year_range(1995, 2050);

    document.getElementById("year").innerHTML = createYear;

    let calendar = document.getElementById("calendar");

    let months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ];
    let days = [
      "Sun", "Mon", "Tue", "Wed",
      "Thu", "Fri", "Sat"
    ];

    $dataHead = "<tr>";
    for (dhead in days) {
      $dataHead += "<th data-days='" +
        days[dhead] + "'>" +
        days[dhead] + "</th>";
    }
    $dataHead += "</tr>";

    document.getElementById("thead-month").innerHTML = $dataHead;

    monthAndYear =
      document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    // Function to navigate to the next month
    function next() {
      currentYear = currentMonth === 11 ?
        currentYear + 1 : currentYear;
      currentMonth = (currentMonth + 1) % 12;
      showCalendar(currentMonth, currentYear);
    }

    // Function to navigate to the previous month
    function previous() {
      currentYear = currentMonth === 0 ?
        currentYear - 1 : currentYear;
      currentMonth = currentMonth === 0 ?
        11 : currentMonth - 1;
      showCalendar(currentMonth, currentYear);
    }

    // Function to jump to a specific month and year
    function jump() {
      currentYear = parseInt(selectYear.value);
      currentMonth = parseInt(selectMonth.value);
      showCalendar(currentMonth, currentYear);
    }

    // Function to display the calendar
    function showCalendar(month, year) {
      let firstDay = new Date(year, month, 1).getDay();
      tbl = document.getElementById("calendar-body");
      tbl.innerHTML = "";
      monthAndYear.innerHTML = months[month] + " " + year;
      selectYear.value = year;
      selectMonth.value = month;

      let date = 1;
      for (let i = 0; i < 6; i++) {
        let row = document.createElement("tr");
        for (let j = 0; j < 7; j++) {
          if (i === 0 && j < firstDay) {
            cell = document.createElement("td");
            cellText = document.createTextNode("");
            cell.appendChild(cellText);
            row.appendChild(cell);
          } else if (date > daysInMonth(month, year)) {
            break;
          } else {
            cell = document.createElement("td");
            cell.setAttribute("data-date", date);
            cell.setAttribute("data-month", month + 1);
            cell.setAttribute("data-year", year);
            cell.setAttribute("data-month_name", months[month]);
            cell.className = "date-picker";
            cell.innerHTML = "<span>" + date + "</span";

            if (
              date === today.getDate() &&
              year === today.getFullYear() &&
              month === today.getMonth()
            ) {
              cell.className = "date-picker selected";
            }

            // Check if there are events on this date
            if (hasEventOnDate(date, month, year)) {
              cell.classList.add("event-marker");
              cell.appendChild(
                createEventTooltip(date, month, year)
              );
            }

            row.appendChild(cell);
            date++;
          }
        }
        tbl.appendChild(row);
      }

      displayReminders();
    }

    // Function to create an event tooltip
    function createEventTooltip(date, month, year) {
      let tooltip = document.createElement("div");
      tooltip.className = "event-tooltip";
      let eventsOnDate = getEventsOnDate(date, month, year);
      for (let i = 0; i < eventsOnDate.length; i++) {
        let event = eventsOnDate[i];
        let eventDate = new Date(event.date);
        let eventText = `<strong>${event.title}</strong> -
      ${event.description} on
      ${eventDate.toLocaleDateString()}`;
        let eventElement = document.createElement("p");
        eventElement.innerHTML = eventText;
        tooltip.appendChild(eventElement);
      }
      return tooltip;
    }

    // Function to get events on a specific date
    function getEventsOnDate(date, month, year) {
      return events.filter(function(event) {
        let eventDate = new Date(event.date);
        return (
          eventDate.getDate() === date &&
          eventDate.getMonth() === month &&
          eventDate.getFullYear() === year
        );
      });
    }

    // Function to check if there are events on a specific date
    function hasEventOnDate(date, month, year) {
      return getEventsOnDate(date, month, year).length > 0;
    }

    // Function to get the number of days in a month
    function daysInMonth(iMonth, iYear) {
      return 32 - new Date(iYear, iMonth, 32).getDate();
    }

    // Call the showCalendar function initially to display the calendar
    showCalendar(currentMonth, currentYear);
  </script>
</body>

</html>
