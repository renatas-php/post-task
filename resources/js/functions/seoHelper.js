import { useHead } from '@unhead/vue';

function setMetaProperties(metaTitle, metaDescription, link)
{
    let meta = useHead({
        title: metaTitle,
        meta: [
            {
                name: 'description',
                content: metaDescription,
            },
            {
                name: 'msapplication-TileColor',
                content: 'rgb(73 159 140',
            },
            {
                name: 'theme-color',
                content: 'rgb(73 159 140',
            },
            {
                name: 'DC.title',
                content: metaTitle,
            },
            {
                name: 'DC.description',
                content: metaDescription ? metaDescription : metaTitle,
            },
            {
                name: 'og:image',
                content: metaTitle,
            },
            {
                name: 'og:image:type',
                content: 'image/jpg',
            },
            {
                name: 'og:description',
                content: metaDescription ? metaDescription : metaTitle,
            },
            {
                name: 'og:title',
                content: metaTitle,
            },
            {
                name: 'og:type',
                content: 'website',
            },
            {
                name: 'og:url',
                content: link,
            },
            {
                name: 'og:site_name',
                content: 'Lygintuvas',
            },
            {
                name: 'author',
                content: 'Lygintuvas',
            }
        ],
    });

    return meta;
}

export default { setMetaProperties }