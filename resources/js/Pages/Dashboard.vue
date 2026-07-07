<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  trending: {
    type: Array,
    default: () => [],
  },
});

const getTitle = (anime) => anime.title.english || anime.title.romaji || anime.title.native;
</script>

<template>
  <VRow>
    <VCol cols="12">
      <h4 class="text-h4 mb-4">🔥 Trending Anime</h4>
    </VCol>

    <VCol
      v-for="anime in props.trending"
      :key="anime.id"
      cols="6"
      sm="4"
      md="3"
      lg="2"
    >
      <VCard>
        <VImg
          :src="anime.coverImage.large"
          height="260"
          cover
        />
        <VCardItem>
          <VCardTitle class="text-body-2">
            {{ getTitle(anime) }}
          </VCardTitle>
        </VCardItem>
        <VCardText class="d-flex align-center justify-space-between pa-3">
          <VChip
            v-if="anime.averageScore"
            size="small"
            color="success"
          >
            ⭐ {{ anime.averageScore }}%
          </VChip>
          <span class="text-caption">
            {{ anime.episodes ? anime.episodes + ' eps' : anime.format }}
          </span>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>