/**
 * Sorts a HTML table.
 * 
 * @param {HTMLTableElement} table The table to sort
 * @param {number} column The index of the column to sort
 * @param {boolean} asc Determines if the sorting will be in ascending
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

//https://codepen.io/dcode-software/pen/zYGOrzK

function searchTable(){
  const searchInput = document.getElementById("search");
  const rows = document.querySelectorAll("tbody tr");
  console.log(rows);
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

//https://github.com/akjasim/cb_js_filter-table/blob/master/index.html