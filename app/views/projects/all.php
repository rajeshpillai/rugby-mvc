<h2>All Projects</h2>

<div>
    <a href="add">Add New Project</a>
</div>


<div id="all_projects" width="100%" >
    <?php
    View::grid($this->model)
    ?>
</div>
<br/>
<div>
    <a href="add">Add New Project</a>
</div>


    <script type="text/javascript">
   
        $(function() {
      
            function setWidth(mainTable, headerTable) {
            
                $(mainTable).parent().width(mainTable.width() + 'px');
                headerTable.width(mainTable.width() + 'px');
            
                // match column widths
                mainTable.find("tbody tr:first td").each(function(i) {
                    headerTable.find("thead tr:first th").get(i).width = "auto";
                    headerTable.find("thead tr:first th").get(i).width = $(this).width();
                
                });
            
                headerTable.find("thead tr:first th").each(function(i) {
                    mainTable.find("tbody tr:first td").get(i).width = $(this).width();
                });
            
                if((mainTable.height() > mainTable.parents(".grid-wrapper").height())) {
                    headerTable.find(".scrollTh").remove();
                    var $newTh = $("<th></th>").addClass("scrollTh").css({
                        padding:0,
                        margin:0,
                        width:15
                    });
                    headerTable.find("tr:first").append($newTh);
                } else if (mainTable.parents(".grid-wrapper").height() > mainTable.height()) {
                    $(".scrollTh").remove();
                }
            
            

            }
        
            $('table.gridxxx').each(function() {
                var $table = $(this);
                // create the header
                var $header = $('<table class="grid-header-row"/>').append($table.find('thead').clone());
                // add wrappers
                $table.wrap('<div class="grid-container"/>')
                .wrap('<div class="grid-wrapper"/>');
                 
           
                // match column/table widths
                setWidth($table, $header);
           
                // Insert header
                $table.closest('.grid-container')
                .prepend($header);

                $table.find("tr:first").remove();      
                // reset tables on window resize
                $(window).resize(function () {
                    setWidth($("grid.table"), $("grid.grid-header-row")); 
                });
            });
        });
    
        (function($) {
            $.fn.createScrollableTable = function(options) {

                var defaults = {
                    width: '400px',
                    height: '300px',
                    border: 'solid 1px #888'
                };
                var options = $.extend(defaults, options);

                return this.each(function() {
                    var table = $(this);
                    prepareTable(table);
                });

                function prepareTable(table) {
                    var tableId = table.attr('id');

                    // wrap the current table (will end up being just body table)
                    var bodyWrap = table.wrap('<div></div>')
                    .parent()
                    .attr('id', tableId + '_body_wrap')
                    .css({
                        width: options.width,
                        height: options.height,
                        overflow: 'auto'
                    });

                    // wrap the body
                    var tableWrap = bodyWrap.wrap('<div></div>')
                    .parent()
                    .attr('id', tableId + '_table_wrap')
                    .css({
                        overflow: 'hidden',
                        display: 'inline-block',
                        border: options.border
                    });

                    // clone the header
                    var headWrap = $(document.createElement('div'))
                    .attr('Id', tableId + '_head_wrap')
                    .prependTo(tableWrap)
                    .css({
                        width: options.width,
                        overflow: 'hidden'
                    });

                    var headTable = table.clone(true)
                    .attr('Id', tableId + '_head')
                    .appendTo(headWrap)
                    .css({
                        'table-layout': 'fixed'
                    });

                    var bufferCol = $(document.createElement('th'))
                    .css({
                        width: '100%'
                    })
                    .appendTo(headTable.find('thead tr'));

                    // remove the extra html
                    headTable.find('tbody').remove();
                    table.find('thead').remove();

                    // size the header columns to match the body
                    var allBodyCols = table.find('tbody tr:first td');
                    headTable.find('thead tr th').each(function(index) {
                        var desiredWidth = getWidth($(allBodyCols[index]));
                        //alert ('Body Width: ' + desiredWidth + ' Header Width: ' + headerWidth);
                        $(this).css({ width: desiredWidth + 'px' });
                    
                    });
                
                    var allHeaderCols = headTable.find('thead tr th');
                    table.find('tbody tr:first td').each (function (index){
                        //var dw = getWidth($(allHeaderCols[index]));
                        var dw = $(allHeaderCols[index]).width();
                        $(this).css({width: dw + 'px'});
                    });
                }

                function getWidth(td) {
                    if ($.browser.msie) { return $(td).outerWidth() - 1; }
                    if ($.browser.mozilla) { return $(td).width(); }
                    if ($.browser.safari) { return $(td).outerWidth(); }
                    return $(td).outerWidth();
                }
            };

        })(jQuery);
    
        /*$(function() {
            $("table.grid").createScrollableTable({
                width: '400px',
                height: '200px'
            });
        });*/
    
    
    </script>