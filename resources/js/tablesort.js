/**
 * Sorts a HTML table.
 */
function sortTableByColumn(table, column, asc = true) {
  const dirModifier = asc ? 1 : -1;
  const tBody = table.tBodies[0];
  const rows = Array.from(tBody.querySelectorAll("tr"));

  // Sort each row
  const sortedRows = rows.sort((a, b) => {
      const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.toLowerCase().trim();
      const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.toLowerCase().trim();

      return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
  });

  // Remove all existing TRs from the table
  while (tBody.firstChild) {
      tBody.removeChild(tBody.firstChild);
  }

  // Re-add the newly sorted rows
  tBody.append(...sortedRows);

  // Remember how the column is currently sorted
  table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
  table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
  table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".table-sortable th").forEach(headerCell => {
  if(headerCell.id == "no-sort"){
    return;
  }
  headerCell.addEventListener("click", () => {
      const tableElement = headerCell.parentElement.parentElement.parentElement;
      const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
      const currentIsAscending = headerCell.classList.contains("th-sort-asc");

      sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
  });
});


/**
 * Allows table to be searched using input
 */
function searchTable(){
  // get the search bar input element
  const searchInput = document.getElementById("search");

  // get all rows from the table
  const rows = document.querySelectorAll("tbody tr");

  // search the table for the entered word each time the user releases a key
  searchInput.addEventListener("keyup", function (event) {
    const q = event.target.value.toLowerCase().trim();
    rows.forEach((row) => {
      row.querySelector("td").textContent.toLowerCase().trim().startsWith(q)
        ? (row.style.display = "table-row")
        : (row.style.display = "none");
    });
  });

}

// check if there is a search element before running the above function
var searchElement = document.getElementById("search");
if(searchElement != null){
  searchTable();
}


/**
 * allows filtering of animals by animal type
 * 
 */
function dropdownsearchTable(){
  // get the dropdown element
  const dropdownSearchInput = document.getElementById("dropdown-search");

  // store an array of all table rows
  const rows = document.querySelectorAll("tbody tr");

  // add a click event to the dropdown element
  dropdownSearchInput.addEventListener("click", function () {
    // if the selected dropdown value is empty then show all rows
    if(dropdownSearchInput.value == ""){
      rows.forEach((row) => {
        row.style.display = "table-row"
      });
      return;
    }
    // for each of the rows, get the columns and check the value of second column "cols[1]" (this is where the animal type is stored)
    // if the animal type is the same as the selected animal type from the dropdown, then show the row, otherwise do not show the row
    rows.forEach((row) => {
      var cols = row.querySelectorAll("td");
      cols[1].textContent.toLowerCase() == dropdownSearchInput.value
      ? (row.style.display = "table-row")
      : (row.style.display = "none");
    });
  });
}

// check if there is a search element before running the above function
var dropdownSearchElement = document.getElementById("dropdown-search");
if(dropdownSearchElement != null){
  dropdownsearchTable();
}
