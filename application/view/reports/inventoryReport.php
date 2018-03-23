<div class="menu-container">
        <div class="list-header">    
        <div class="title"><i class="fas fa-shopping-bag display-icon"></i>Inventory Report</div>
        </div>
        <!-- main content output -->
    
        <div class="list-content">
        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td class="td-small">Description</td>
                <td class="td-small">Amount</td>
                <td class="td-small">Unit</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ingredients as $ingredient) { ?>
                <tr>
                    <td><?php if (isset($ingredient->name)) echo htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->description)) echo htmlspecialchars($ingredient->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->amount)) echo htmlspecialchars($ingredient->amount, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->unit)) echo htmlspecialchars($ingredient->unit, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
