var tags = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: '/data/tags',
        filter: function(list) {
            return $.map(list, function(name) {
                return { name: name }; });
        }
    }
});
tags.initialize();

$('#tags-input').tagsinput({
    confirmKeys: [13, 44],
    typeaheadjs: {
        name: 'tags',
        displayKey: 'name',
        valueKey: 'name',
        source: tags.ttAdapter()
    },
    freeInput: true
});