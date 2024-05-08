let orders = {};

const handleMenuItem = (operation, menuId) => {
    let qtyElement = document.getElementById(`menu-${menuId}-qty`);
    let currentQty = parseInt(qtyElement.value);

    if (operation === "-") {
        if (currentQty <= 0) {
            return;
        }

        currentQty--;
        qtyElement.value = currentQty;
    } else {
        currentQty++;
        qtyElement.value = currentQty;
    }

    if (currentQty <= 0) {
        deleteOrder(menuId);
        return;
    } else {
        orders[menuId] = {
            "idMenu" : menuId,
            "qty" : currentQty,
            "namaMenu" : qtyElement.getAttribute('data-menu-nama'),
            "hargaMenu" : parseInt(qtyElement.getAttribute('data-menu-harga')),
        }
    }

    refreshOrders();
}

const refreshOrders = () => {
    if (Object.keys(orders).length == 0) {
        document.getElementById("list-pesanan").style.display = "none";
    } else {
        let html = ``;

        let total = 0;

        Object.keys(orders).forEach(menuId => {
            total += (orders[menuId].hargaMenu * orders[menuId].qty);
            
            html += `<tr>
                        <input type="hidden" name="orders[${menuId}]" value="${orders[menuId].qty}" required>
                        <td width="50%">${orders[menuId].namaMenu}</td>
                        <td width="5%">x${orders[menuId].qty}</td>
                        <td class="text-end">${rupiah(orders[menuId].hargaMenu * orders[menuId].qty)}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-danger" title="Delete Item" onclick="deleteOrder(${menuId})">
                                <i class="bi-x-lg"></i>
                            </button>
                        </td>
                    </tr>`;
        });

        document.getElementById("tbody-list-pesanan").innerHTML = html;
        
        document.getElementById("total-list-pesanan").innerText = rupiah(total);

        document.getElementById("list-pesanan").style.display = "unset";
    }
}

const deleteOrder = (menuId) => {
    delete orders[menuId];
    document.getElementById(`menu-${menuId}-qty`).value = "0";
    refreshOrders();
}

const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    }).format(number);
}

const openDetailMenu = (menuId) => {
    window.location.href = 'detail-menu.php?id=' + menuId;
}

function deleteData(fileIndex, tableName, id)
{
    let inputId        = document.getElementById('form-delete-id');
    let inputTableName = document.getElementById('form-delete-table-name');
    let inputFileIndex = document.getElementById('form-delete-file-index');
    let formDeleteData = document.getElementById('form-delete-data');

    let isConfirmed = confirm("Konfirmasi hapus data ?");

    if (isConfirmed) {
        inputId.value = id;
        inputTableName.value = tableName;
        inputFileIndex.value = fileIndex;

        formDeleteData.submit();
    }
}