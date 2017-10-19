<?php 
    /* 
    ** Quick HTML menus with minimum and maximum sets of years.
    ** @author Chris Charlton <chris@laflash.org>
    ** @license FREE!
    */

    // Years range setup
    $year_built_min = 1900;
    $year_built_max = date("Y");
?>
<select id="yearBuiltMin" size="1">
    <?php // Generate minimum years 

        foreach (range($year_built_min, $year_built_max) as $year) { ?>
        <option value="<?php echo($year); ?>"><?php echo($year); ?></option>
        <?php } ?>
</select>

<select id="yearBuiltMax" size="1">
      <?php // Generate max years 

        foreach (range($year_built_max, $year_built_min) as $year) { ?>
        <option value="<?php echo($year); ?>"><?php echo($year); ?></option>
        <?php } ?>
</select>